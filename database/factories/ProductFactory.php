<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Product\Enums\ProductType;
use Quicktane\Core\Product\Models\AttributeGroup;
use Quicktane\Core\Product\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'type' => ProductType::SIMPLE,
            'sku' => $this->faker->ean8(),
            'status' => 'active',
            'quantity' => 10,
            'attribute_group_id' => AttributeGroup::factory()
        ];
    }
}
