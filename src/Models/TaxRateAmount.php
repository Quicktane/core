<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\TaxRateFactory;

/**
 * @property int $id
 * @property int $tax_class_id
 * @property int $tax_rate_id
 * @property string $percentage
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class TaxRateAmount extends BaseModel
{
    use HasFactory;

    protected $guarded = [];


//    protected static function newFactory(): TaxRateFactory
//    {
//        return TaxRateFactory::new();
//    }
}
