<?php

namespace Quicktane\Core\Product\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Base\Casts\MoneyIntegerCast;
use Quicktane\Core\Customer\Models\CustomerGroup;
use Quicktane\Core\Database\Factories\PriceFactory;

/**
 * @property int      $id
 * @property ?int     $customer_group_id
 * @property ?int     $currency_id
 * @property int      $product_id
 * @property int      $amount
 * @property ?Carbon  $created_at
 * @property ?Carbon  $updated_at
 * @property Currency $currency
 * @property Product  $product
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Price extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'amount' => MoneyIntegerCast::class,
    ];

    protected static function newFactory(): PriceFactory
    {
        return PriceFactory::new();
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Return the customer group relationship.
     */
    public function customerGroup(): BelongsTo
    {
        return $this->belongsTo(CustomerGroup::class);
    }
}
