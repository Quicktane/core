<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Product\Models\Attribute;

class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    public function definition(): array
    {
        return [
            'name' => 'Name',
            'slug' => 'name',
            'type' => 'string',
        ];
    }

    public function string(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'string',
            ];
        });
    }

    public function integer(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'integer',
            ];
        });
    }
}
