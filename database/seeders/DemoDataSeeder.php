<?php

namespace Quicktane\Core\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Quicktane\Core\Models\Attribute;
use Quicktane\Core\Models\AttributeGroup;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
//        $this->truncateTables([
//            Language::class
//        ]);

//        Channel::factory()->create();
//        Language::factory()->create();
//        Url::factory()->create();
//        Currency::factory()->create();
//        Price::factory()->create();
//        TaxClass::factory()->create();
//        CustomerGroup::factory()->create();
//        CustomerGroupProduct::factory()->create();
//        Customer::factory()->create();
//        Country::factory()->create();

        $attributes = Attribute::factory()
            ->string()
            ->sequence(
                ['name' => 'Name', 'slug' => 'name'],
                ['name' => 'Description', 'slug' => 'description'],
                ['name' => 'color', 'slug' => 'color'],
            )->count(3)
            ->create();

        $attributesForGroup2 = Attribute::factory()
            ->string()
            ->sequence(
                ['name' => 'Length', 'slug' => 'length'],
                ['name' => 'Width', 'slug' => 'width'],
                ['name' => 'Height', 'slug' => 'height'],
            )->count(3)
            ->create();

        $attributesForGroup2->push($attributes->first());

        $attributeGroup = AttributeGroup::factory()->create();
        $attributeGroup->customAttributes()->attach($attributes->pluck('id')->toArray());

        $attributeGroup = AttributeGroup::factory()->create(['name' => 'Group 2', 'slug' => 'group_2']);
        $attributeGroup->customAttributes()->attach($attributesForGroup2->pluck('id')->toArray());
    }

    protected function truncateTables(array $models): void
    {
        collect($models)->each(fn(string|Model $model) => $model::query()->del());
    }
}
