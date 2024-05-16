<?php

namespace Quicktane\Core\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\NodeTrait;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\CategoryFactory;
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
 * @property ?Collection $products
 */
class Category extends BaseModel
{
    use HasFactory, NodeTrait;

    protected $guarded = [];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, "qt_category_products")
            ->withPivot(['position'])
            ->withTimestamps()
            ->orderByPivot('position');
    }
}
