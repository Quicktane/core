<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Product\Models\AttributeGroup;

class AttributeGroupFactory extends Factory
{
    protected $model = AttributeGroup::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'position' => $this->faker->numberBetween(1, 10),
        ];
    }
}
