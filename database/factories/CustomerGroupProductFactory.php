<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Models\CustomerGroup;
use Quicktane\Core\Models\CustomerGroupProduct;
use Quicktane\Core\Models\Product;

class CustomerGroupProductFactory extends Factory
{
    protected $model = CustomerGroupProduct::class;

    public function definition(): array
    {
        return [
            'customer_group_id' => CustomerGroup::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
