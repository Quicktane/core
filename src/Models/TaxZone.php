<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\TaxZoneFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $zone_type
 * @property string $price_display
 * @property bool $active
 * @property bool $default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class TaxZone extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean',
        'default' => 'boolean',
    ];

    protected static function newFactory(): TaxZoneFactory
    {
        return TaxZoneFactory::new();
    }
}
