<?php

namespace Quicktane\Core\Cart\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lunar\Database\Factories\CartAddressFactory;
use Lunar\Models\Cart;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Models\Country;
use Quicktane\Core\Models\Price;
use Quicktane\Core\Models\ShippingOption;
use Quicktane\Core\Models\TaxBreakdown;

/**
 * @property int $id
 * @property int $cart_id
 * @property ?int $country_id
 * @property ?string $title
 * @property ?string $first_name
 * @property ?string $last_name
 * @property ?string $company_name
 * @property ?string $line_one
 * @property ?string $line_two
 * @property ?string $line_three
 * @property ?string $city
 * @property ?string $state
 * @property ?string $postcode
 * @property ?string $delivery_instructions
 * @property ?string $contact_email
 * @property ?string $contact_phone
 * @property string $type
 * @property ?string $shipping_option
 * @property array $meta
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class CartAddress extends BaseModel
{
    use HasFactory;

    /**
     * The applied shipping option.
     */
    public ?ShippingOption $shippingOption = null;

    /**
     * The shipping sub total.
     */
    public ?Price $shippingSubTotal = null;

    /**
     * The shipping tax total.
     */
    public ?Price $shippingTaxTotal = null;

    /**
     * The shipping total.
     */
    public ?Price $shippingTotal = null;

    /**
     * The tax breakdown.
     */
    public ?TaxBreakdown $taxBreakdown = null;

    /**
     * Return a new factory instance for the model.
     */
    protected static function newFactory(): CartAddressFactory
    {
        return CartAddressFactory::new();
    }

    /**
     * Define which attributes should be
     * protected from mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'title',
        'first_name',
        'last_name',
        'company_name',
        'line_one',
        'line_two',
        'line_three',
        'city',
        'state',
        'postcode',
        'delivery_instructions',
        'contact_email',
        'contact_phone',
        'meta',
        'type',
        'shipping_option',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'meta' => AsArrayObject::class,
    ];

    /**
     * Return the cart relationship.
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Return the country relationship.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}