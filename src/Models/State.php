<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property ?int $country_id
 * @property string $name
 * @property string $code
 * @property ?\Illuminate\Support\Carbon $created_at
 * @property ?\Illuminate\Support\Carbon $updated_at
 */
class State extends BaseModel
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
     * Return the country relationship.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
