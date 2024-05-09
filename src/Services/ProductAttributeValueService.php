<?php

namespace Quicktane\Core\Services;

use Quicktane\Core\Models\Attribute;
use Quicktane\Core\Models\Product;
use Quicktane\Core\Models\ProductAttributeValue;

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