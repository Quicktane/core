<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Customer\Models\CustomerGroup;
use Quicktane\Core\Product\Models\Product;

/**
 * @property int $id
 * @property int $category_group_id
 * @property-read  int $_lft
 * @property-read  int $_rgt
 * @property ?int $parent_id
 * @property string $type
 * @property string $sort
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 * @property ?Carbon $deleted_at
 */
class Category extends BaseModel
{
//    use HasFactory, NodeTrait;

    protected $guarded = [];

    /**
     * Return the group relationship.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(CategoryGroup::class, 'collection_group_id');
    }

    public function scopeInGroup(Builder $builder, int $id): Builder
    {
        return $builder->where('collection_group_id', $id);
    }

    /**
     * Return the products relationship.
     */
    public function products(): BelongsToMany
    {
        $prefix = config('quicktane.database.table_prefix');

        return $this->belongsToMany(
            Product::class,
            "{$prefix}collection_product"
        )->withPivot([
            'position',
        ])->withTimestamps()->orderByPivot('position');
    }

    /**
     * Get the translated name of ancestor collections.
     */
    public function getBreadcrumbAttribute(): \Illuminate\Support\Collection
    {
        return $this->ancestors->map(function ($ancestor) {
            return $ancestor->translateAttribute('name');
        });
    }

    /**
     * Return the customer groups relationship.
     */
    public function customerGroups(): BelongsToMany
    {
        $prefix = config('Quicktane.database.table_prefix');

        return $this->belongsToMany(
            CustomerGroup::class,
            "{$prefix}collection_customer_group"
        )->withPivot([
            'visible',
            'enabled',
            'starts_at',
            'ends_at',
        ])->withTimestamps();
    }
}
