<?php

namespace Quicktane\Core\Product\Services;

use Quicktane\Core\Models\ProductAttributeValue;
use Quicktane\Core\Product\Models\Attribute;
use Quicktane\Core\Product\Models\Product;

class ProductAttributeValueService
{
    public function find(Product $product, Attribute $attribute): ?ProductAttributeValue
    {
        return ProductAttributeValue::query()
            ->where('product_id', $product->id)
            ->where('attribute_id', $attribute->id)
            ->first();
    }
}