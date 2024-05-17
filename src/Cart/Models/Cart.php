<?php

namespace Quicktane\Core\Cart\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Customer\Models\Customer;
use Quicktane\Core\Models\Currency;

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
 * @method static static|QueryBuilder|Builder query()
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
}
