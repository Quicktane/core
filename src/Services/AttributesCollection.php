<?php

namespace Quicktane\Core\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Models\Attribute;

class AttributesCollection extends Collection
{
    public function attributeKeys(): static
    {
        return $this->map(fn(Attribute $attribute) => $attribute->slug);
    }
}