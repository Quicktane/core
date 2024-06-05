<?php

namespace Quicktane\Core\Product\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Quicktane\Core\Base\Model;
use Quicktane\Core\Database\Factories\AttributeFactory;
use Quicktane\Core\Models\ProductAttributeValue;
use Quicktane\Core\Product\Enums\AttributeType;

/**
 * @property int           $id
 * @property string        $name
 * @property string        $slug
 * @property AttributeType $type
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Attribute extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => AttributeType::class,
    ];

    protected static function newFactory(): AttributeFactory
    {
        return AttributeFactory::new();
    }

    protected $guarded = [];

    public function options(): HasOne
    {
        return $this->hasOne(AttributeOption::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
