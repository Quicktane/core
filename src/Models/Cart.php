<?php

namespace Quicktane\Core\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int     $id
 * @property ?int    $user_id
 * @property ?int    $customer_id
 * @property ?int    $merged_id
 * @property int     $currency_id
 * @property int     $channel_id
 * @property ?int    $order_id
 * @property ?string $coupon_code
 * @property ?Carbon $completed_at
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Cart extends BaseModel
{
    use HasFactory;

    /**
     * Define which attributes should be
     * protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'completed_at' => 'datetime',
        'meta'         => AsArrayObject::class,
    ];

    /**
     * Return the currency relationship.
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Return the customer relationship.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }


    /**
     * Return the addresses relationship.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(CartAddress::class, 'cart_id');
    }

    /**
     * Return the shipping address relationship.
     */
    public function shippingAddress(): HasOne
    {
        return $this->hasOne(CartAddress::class, 'cart_id')->whereType('shipping');
    }

    /**
     * Return the billing address relationship.
     */
    public function billingAddress(): HasOne
    {
        return $this->hasOne(CartAddress::class, 'cart_id')->whereType('billing');
    }

    /**
     * Return the order relationship.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Return the draft order relationship.
     */
    public function draftOrder(int $draftOrderId = null): HasOne
    {
        return $this->hasOne(Order::class)
            ->when($draftOrderId, function (Builder $query, int $draftOrderId) {
                $query->where('id', $draftOrderId);
            })->whereNull('placed_at');
    }

    /**
     * Return the completed order relationship.
     */
    public function completedOrder(int $completedOrderId = null): HasOne
    {
        return $this->hasOne(Order::class)
            ->when($completedOrderId, function (Builder $query, int $completedOrderId) {
                $query->where('id', $completedOrderId);
            })->whereNotNull('placed_at');
    }

    /**
     * Return the carts completed order.
     */
    public function completedOrders(): HasMany
    {
        return $this->hasMany(Order::class)
            ->whereNotNull('placed_at');
    }

    /**
     * Return whether the cart has any completed order.
     */
    public function hasCompletedOrders(): bool
    {
        return (bool) $this->completedOrders()->count();
    }

    /**
     * Add or update a purchasable item to the cart
     */
    public function add(Purchasable $purchasable, int $quantity = 1, array $meta = [], bool $refresh = true): Cart
    {
        foreach (config('lunar.cart.validators.add_to_cart', []) as $action) {
            // Throws a validation exception?
            app($action)->using(
                cart: $this,
                purchasable: $purchasable,
                quantity: $quantity,
                meta: $meta
            )->validate();
        }

        return app(
            config('lunar.cart.actions.add_to_cart', AddOrUpdatePurchasable::class)
        )->execute($this, $purchasable, $quantity, $meta)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    /**
     * Add cart lines.
     */
    public function addLines(iterable $lines): Cart
    {
        DB::transaction(function () use ($lines) {
            collect($lines)->each(function ($line) {
                $this->add(
                    purchasable: $line['purchasable'],
                    quantity: $line['quantity'],
                    meta: (array) ($line['meta'] ?? null),
                    refresh: false
                );
            });
        });

        return $this->refresh()->calculate();
    }

    /**
     * Remove a cart line
     */
    public function remove(int $cartLineId, bool $refresh = true): Cart
    {
        foreach (config('lunar.cart.validators.remove_from_cart', []) as $action) {
            app($action)->using(
                cart: $this,
                cartLineId: $cartLineId,
            )->validate();
        }

        return app(
            config('lunar.cart.actions.remove_from_cart', RemovePurchasable::class)
        )->execute($this, $cartLineId)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    /**
     * Update cart line
     */
    public function updateLine(int $cartLineId, int $quantity, array $meta = null, bool $refresh = true): Cart
    {
        foreach (config('lunar.cart.validators.update_cart_line', []) as $action) {
            app($action)->using(
                cart: $this,
                cartLineId: $cartLineId,
                quantity: $quantity,
                meta: $meta
            )->validate();
        }

        return app(
            config('lunar.cart.actions.update_cart_line', UpdateCartLine::class)
        )->execute($cartLineId, $quantity, $meta)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    /**
     * Update cart lines.
     */
    public function updateLines(Collection $lines): Cart
    {
        DB::transaction(function () use ($lines) {
            $lines->each(function ($line) {
                $this->updateLine(
                    cartLineId: $line['id'],
                    quantity: $line['quantity'],
                    meta: $line['meta'] ?? null,
                    refresh: false
                );
            });
        });

        return $this->refresh()->calculate();
    }

    /**
     * Deletes all cart lines.
     */
    public function clear(): Cart
    {
        $this->lines()->delete();

        return $this->refresh()->calculate();
    }

    /**
     * Associate a user to the cart
     */
    public function associate(User $user, string $policy = 'merge', bool $refresh = true): Cart
    {
        if ($this->customer()->exists()) {
            if (!$user->query()
                ->whereHas('customers', fn($query) => $query->where('customer_id', $this->customer->id))
                ->exists()) {
                throw new Exception('Invalid user');
            }
        }

        return app(
            config('lunar.cart.actions.associate_user', AssociateUser::class)
        )->execute($this, $user, $policy)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    /**
     * Associate a customer to the cart
     */
    public function setCustomer(Customer $customer): Cart
    {
        if ($this->user()->exists()) {
            if (!$customer->query()
                ->whereHas('users', fn($query) => $query->where('user_id', $this->user->id))
                ->exists()) {
                throw new Exception('Invalid customer');
            }
        }

        $this->customer()->associate($customer)->save();

        return $this->refresh()->calculate();
    }

    /**
     * Add an address to the Cart.
     */
    public function addAddress(array|Addressable $address, string $type, bool $refresh = true): Cart
    {
        foreach (config('lunar.cart.validators.add_address', []) as $action) {
            app($action)->using(
                cart: $this,
                address: $address,
                type: $type,
            )->validate();
        }

        return app(
            config('lunar.cart.actions.add_address', AddAddress::class)
        )->execute($this, $address, $type)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    /**
     * Set the shipping address.
     */
    public function setShippingAddress(array|Addressable $address): Cart
    {
        return $this->addAddress($address, 'shipping');
    }

    /**
     * Set the billing address.
     */
    public function setBillingAddress(array|Addressable $address): Cart
    {
        return $this->addAddress($address, 'billing');
    }

    /**
     * Set the shipping option to the shipping address.
     */
    public function setShippingOption(ShippingOption $option, bool $refresh = true): Cart
    {
        foreach (config('lunar.cart.validators.set_shipping_option', []) as $action) {
            app($action)->using(
                cart: $this,
                shippingOption: $option,
            )->validate();
        }

        return app(
            config('lunar.cart.actions.set_shipping_option', SetShippingOption::class)
        )->execute($this, $option)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    /**
     * Get the shipping option for the cart
     */
    public function getShippingOption(): ?ShippingOption
    {
        return ShippingManifest::getShippingOption($this);
    }

    /**
     * Returns whether the cart has shippable items.
     */
    public function isShippable(): bool
    {
        return (bool) $this->lines->filter(function ($line) {
            return $line->purchasable->isShippable();
        })->count();
    }

    /**
     * Create an order from the Cart.
     */
    public function createOrder(
        bool $allowMultipleOrders = false,
        int $orderIdToUpdate = null
    ): Order {
        foreach (
            config('lunar.cart.validators.order_create', [
                ValidateCartForOrderCreation::class,
            ]) as $action
        ) {
            app($action)->using(
                cart: $this,
            )->validate();
        }

        return app(
            config('lunar.cart.actions.order_create', CreateOrder::class)
        )->execute(
            $this->refresh()->calculate(),
            $allowMultipleOrders,
            $orderIdToUpdate
        )->then(fn($order) => $order->refresh());
    }

    /**
     * Returns whether a cart has enough info to create an order.
     */
    public function canCreateOrder(): bool
    {
        $passes = true;

        foreach (
            config('lunar.cart.validators.order_create', [
                ValidateCartForOrderCreation::class,
            ]) as $action
        ) {
            try {
                app($action)->using(
                    cart: $this,
                )->validate();
            } catch (CartException $e) {
                $passes = false;
            }
        }

        return $passes;
    }

    /**
     * Get a unique fingerprint for the cart to identify if the contents have changed.
     */
    public function fingerprint(): string
    {
        $generator = config('lunar.cart.fingerprint_generator', GenerateFingerprint::class);

        return (new $generator())->execute($this);
    }

    /**
     * Check whether a given fingerprint matches the one being generated for the cart.
     *
     * @throws FingerprintMismatchException
     */
    public function checkFingerprint(string $fingerprint): bool
    {
        return tap($fingerprint == $this->fingerprint(), function ($result) {
            throw_unless(
                $result,
                FingerprintMismatchException::class
            );
        });
    }

    /**
     * Return the estimated shipping cost for a cart.
     */
    public function getEstimatedShipping(array $params, bool $setOverride = false): ?ShippingOption
    {
        $this->shippingEstimateMeta = $params;
        $option = ShippingManifest::getOptions($this)
            ->filter(
                fn($option) => !$option->collect
            )->sortBy('price.value')->first();

        if ($setOverride && $option) {
            $this->shippingOptionOverride = $option;
        }

        return $option;
    }
}
