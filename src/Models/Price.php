<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Base\Casts\Price as PriceCast;
use Quicktane\Core\Customer\Models\CustomerGroup;
use Quicktane\Core\Database\Factories\PriceFactory;
use Quicktane\Core\Product\Models\Product;

/**
 * @property int $id
 * @property ?int $customer_group_id
 * @property ?int $currency_id
 * @property int $product_id
 * @property int $price
 * @property ?int $compare_price
 * @property int $tier
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property Currency $currency
 * @property Product $product
 */
class Price extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'price' => PriceCast::class,
        'compare_price' => PriceCast::class,
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
