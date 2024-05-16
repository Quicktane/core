<?php

namespace Quicktane\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Quicktane\Core\Category\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->title,
            'slug' => $this->faker->slug,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            /** @var Category $parentCategory */
            $parentCategory = Category::inRandomOrder()->first();

            if ($parentCategory && $category->id !== $parentCategory->id) {
                $category->appendToNode($parentCategory)->save();
            }
        });
    }
}
