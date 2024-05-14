<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Models\Currency;
use Quicktane\Core\Models\Price;
use Quicktane\Core\Product\Models\Product;

class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(1, 2500),
            'compare_price' => $this->faker->numberBetween(1, 2500),
            'currency_id' => Currency::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
