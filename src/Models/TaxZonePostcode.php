<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property ?int $tax_zone_id
 * @property ?int $country_id
 * @property string $postcode
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class TaxZonePostcode extends BaseModel
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
     * Return the tax zone relation.
     */
    public function taxZone(): BelongsTo
    {
        return $this->belongsTo(TaxZone::class);
    }

    /**
     * Return the country relation.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
