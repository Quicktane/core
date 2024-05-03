<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\TaxClassFactory;

/**
 * @property int $id
 * @property string $name
 * @property bool $default
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class TaxClass extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    public static function booted()
    {
        static::updated(function ($taxClass) {
            if ($taxClass->default) {
                TaxClass::whereDefault(true)->where('id', '!=', $taxClass->id)->update([
                    'default' => false,
                ]);
            }
        });

        static::created(function ($taxClass) {
            if ($taxClass->default) {
                TaxClass::whereDefault(true)->where('id', '!=', $taxClass->id)->update([
                    'default' => false,
                ]);
            }
        });
    }

    protected static function newFactory(): TaxClassFactory
    {
        return TaxClassFactory::new();
    }
}
