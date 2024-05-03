<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\ProductFactory;

/**
 * @property int $id
 * @property ?int $brand_id
 * @property int $product_type_id
 * @property string $status
 * @property array $attribute_data
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Carbon $deleted_at
 */
class Product extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Return a new factory instance for the model.
     */
    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    protected $guarded = [];
}
