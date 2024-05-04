<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'type' => 'dummy',
            'sku' => $this->faker->ean8(),
            'status' => 'active',
            'quantity' => 10,
        ];
    }
}
