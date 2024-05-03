<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\TaxClassFactory;
use Quicktane\Core\Database\Factories\TaxRateFactory;

/**
 * @property int $id
 * @property int $tax_zone_id
 * @property int $priority
 * @property string $name
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class TaxRate extends BaseModel
{
    use HasFactory;

    protected $guarded = [];


    protected static function newFactory(): TaxRateFactory
    {
        return TaxRateFactory::new();
    }
}
