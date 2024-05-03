<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property ?int $tax_zone_id
 * @property ?int $state_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class TaxZoneState extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    public function taxZone(): BelongsTo
    {
        return $this->belongsTo(TaxZone::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
