<?php

namespace Quicktane\Core\Category\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Product\Models\Product;

class CategorySyncService
{
    public function attach(array $productsIds, array $categoriesIds): void
    {
        $this->products($productsIds)->map(function (Product $product) use ($categoriesIds) {
            $product->categories()->withTimestamps()->attach($categoriesIds);
        });
    }

    public function detach(array $productsIds, array $categoriesIds): void
    {
        $this->products($productsIds)->map(function (Product $product) use ($categoriesIds) {
            $product->categories()->withTimestamps()->detach($categoriesIds);
        });
    }

    protected function products(array $productsIds): Collection
    {
        return Product::query()->whereIn('id', $productsIds)->get();
    }
}
