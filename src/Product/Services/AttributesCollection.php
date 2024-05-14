<?php

namespace Quicktane\Core\Product\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Product\Models\Attribute;

class AttributesCollection extends Collection
{
    public function attributeKeys(): static
    {
        return $this->map(fn(Attribute $attribute) => $attribute->slug);
    }
}