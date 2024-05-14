<?php

namespace Quicktane\Core\Product\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Quicktane\Core\Base\Model;
use Quicktane\Core\Database\Factories\AttributeGroupFactory;

/**
 * @property int        $id
 * @property string     $slug
 * @property ?Carbon    $created_at
 * @property ?Carbon    $updated_at
 * @property Collection $customAttributes
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class AttributeGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory(): AttributeGroupFactory
    {
        return AttributeGroupFactory::new();
    }

    public function customAttributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'qt_attribute_group_attributes');
    }
}
