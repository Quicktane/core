<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Models\Language;
use Quicktane\Core\Models\Url;
use Quicktane\Core\Product\Models\Product;

class UrlFactory extends Factory
{
    protected $model = Url::class;

    public function definition(): array
    {
        return [
            'language_id' => Language::factory(),
            'element_type' => Product::class,
            'element_id' => 1,
            'slug' => $this->faker->slug,
            'default' => true,
        ];
    }
}
