<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Models\TaxClass;
use Quicktane\Core\Models\TaxZone;

class TaxRateFactory extends Factory
{
    protected $model = TaxClass::class;

    public function definition(): array
    {
        return [
            'tax_zone_id' => TaxZone::factory(),
            'priority' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name,
        ];
    }
}
