<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\CurrencyFactory;
use Quicktane\Core\Product\Models\Price;

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
 * @method static static|QueryBuilder|EloquentBuilder query()
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
