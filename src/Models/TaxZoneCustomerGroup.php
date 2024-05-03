<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Lunar\Database\Factories\TaxZoneCustomerGroupFactory;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property ?int $tax_zone_id
 * @property ?int $customer_group_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class TaxZoneCustomerGroup extends BaseModel
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
     * Return the customer group relation.
     */
    public function customerGroup(): BelongsTo
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    /**
     * Return the tax zone relation.
     */
    public function taxZone(): BelongsTo
    {
        return $this->belongsTo(TaxZone::class);
    }
}
