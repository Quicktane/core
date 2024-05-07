<?php

namespace Quicktane\Core\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Quicktane\Core\Models\Attribute;
use Quicktane\Core\Models\Product;
use Quicktane\Core\Models\ProductAttributeValue;

class ProductAttributesService
{
    public function saveValues(Product $product, AttributesCollection $attributes, array $attributesMap): Collection
    {
        $attributeValues = Arr::only($attributesMap, $attributes->attributeKeys()->toArray());

        //todo add check for required attributes and also add validation
        return $attributes->map(function (Attribute $attribute) use ($product, $attributeValues) {
            return $this->saveValue($product, $attribute, $attributeValues[$attribute->slug] ?? null);
        });
    }

    public function saveValue(Product $product, Attribute $attribute, $value): ProductAttributeValue
    {
        /** @var ProductAttributeValue $attributeValue */
        $attributeValue = ProductAttributeValue::query()->newModelInstance([
            'value' => $value,
        ]);
        $attributeValue->attribute()->associate($attribute);
        $attributeValue->product()->associate($product);

        $attributeValue->save();

        return $attributeValue;
    }
}