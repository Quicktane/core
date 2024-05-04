<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Quicktane\Core\Base\BaseModel;
use Quicktane\Core\Database\Factories\ProductFactory;
use Quicktane\Core\Enums\ProductType;
use Quicktane\Core\Services\ProductAttributesCollection;

/**
 * @property int        $id
 * @property ?int       $brand_id
 * @property int        $product_type_id
 * @property string     $status
 * @property array      $attribute_data
 * @property ?Carbon    $created_at
 * @property ?Carbon    $updated_at
 * @property ?Carbon    $deleted_at
 * @property Collection $customAttributes
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

    public function attributeGroups(): BelongsToMany
    {
        return $this->belongsToMany(AttributeGroup::class, 'qt_product_attribute_groups');
    }

    public function customAttributeCollection(): ProductAttributesCollection
    {
        //todo make more flexible
        return $this->customAttributes ??= new ProductAttributesCollection($this);
    }
}
