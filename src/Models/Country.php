<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\CountryFactory;
use Quicktane\Core\Database\Factories\CustomerFactory;

/**
 * @property int $id
 * @property string $name
 * @property string $iso3
 * @property ?string $iso2
 * @property string $phoneCode
 * @property ?string $capital
 * @property string $currency
 * @property ?string $native
 * @property string $emoji
 * @property string $emoji_u
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class Country extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}
