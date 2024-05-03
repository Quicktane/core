<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Models\TaxClass;

class TaxClassFactory extends Factory
{
    protected $model = TaxClass::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'default' => false,
        ];
    }
}
