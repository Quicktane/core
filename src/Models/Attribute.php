<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Quicktane\Core\Base\Model;
use Quicktane\Core\Database\Factories\AttributeFactory;

/**
 * @property int    $id
 * @property string $slug
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Attribute extends Model
{
    use HasFactory;

    protected static function newFactory(): AttributeFactory
    {
        return AttributeFactory::new();
    }

    protected $guarded = [];

    public function value()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
