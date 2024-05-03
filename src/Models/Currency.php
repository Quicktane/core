<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\CurrencyFactory;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property float $exchange_rate
 * @property int $decimal_places
 * @property bool $enabled
 * @property bool $default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class Currency extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): CurrencyFactory
    {
        return CurrencyFactory::new();
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}
