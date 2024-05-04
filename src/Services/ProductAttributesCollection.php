<?php

namespace Quicktane\Core\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Models\Attribute;
use Quicktane\Core\Models\Product;

class ProductAttributesCollection
{
    protected Collection $customAttributes;

    public function __construct(
        protected readonly Product $product
    ) {
        $this->customAttributes = $this->getCustomAttributes()
            ->mapWithKeys(
                fn(Attribute $attribute) => [$attribute->slug => $attribute]
            );
    }

    public function attributeKeys(): Collection
    {
        return $this->customAttributes->keys();
    }

    public function getAttributeValue(string $key)
    {
        return $this->customAttributes[$key]?->value ?? null;
    }

    protected function getCustomAttributes(): Collection
    {
        //todo refactor it
        return Attribute::query()
            ->select('qt_attributes.*', 'pav.value')
            ->join('qt_product_attributes as pa', 'pa.attribute_id', '=', 'qt_attributes.id')
            ->leftJoin('qt_product_attribute_values as pav', 'qt_attributes.id', '=', 'pav.attribute_id')
            ->where(['pa.product_id' => $this->product->id])
            ->get();
    }
}