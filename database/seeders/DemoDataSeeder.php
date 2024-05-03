<?php

namespace Quicktane\Core\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Quicktane\Core\Models\Country;

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
        Country::factory()->create();
    }

    protected function truncateTables(array $models): void
    {
        collect($models)->each(fn(string|Model $model) => $model::query()->del());
    }
}
