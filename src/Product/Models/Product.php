<?php

namespace Quicktane\Core\Product\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Category\Models\Category;
use Quicktane\Core\Database\Factories\ProductFactory;
use Quicktane\Core\Product\Enums\ProductType;
use Quicktane\Core\Product\Services\ProductAttributesCollection;

/**
 * @property int               $id
 * @property ?int              $brand_id
 * @property int               $product_type_id
 * @property string            $status
 * @property array             $attribute_data
 * @property ?Carbon           $created_at
 * @property ?Carbon           $updated_at
 * @property ?Carbon           $deleted_at
 * @property Collection        $customAttributes
 * @property AttributeGroup    $attributeGroup
 * @property Collection        $categories
 * @property Collection<Price> $prices
 * @property ProductType       $type
 * @method static static|QueryBuilder|EloquentBuilder query()
 */
class Product extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected ?ProductAttributesCollection $customAttributes = null;

    /**
     * Return a new factory instance for the model.
     */
    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    protected $guarded = [];

    protected $casts = [
        'type' => ProductType::class,
    ];

    public function customAttributes(): BelongsToMany
    {
        //todo change table name
        return $this->belongsToMany(Attribute::class, 'qt_product_attributes');
    }

    public function attributeGroup(): BelongsTo
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'qt_category_products');
    }

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(static::class, 'qt_product_variants');
    }

    public function variantOptions()
    {
        return $this->belongsToMany(AttributeOption::class, 'qt_product_variant_options', relatedPivotKey: 'option_id');
    }

    public function customAttributeCollection(): ProductAttributesCollection
    {
        //todo make more flexible
        return $this->customAttributes ??= new ProductAttributesCollection($this);
    }
}
