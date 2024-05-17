<?php

namespace Quicktane\Core\Category\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Category\DTO\CategoriesIdsDto;
use Quicktane\Core\Category\DTO\ProductsIdsDto;
use Quicktane\Core\Product\Models\Product;

class CategorySyncService
{
    //TODO isn't that overhead validation? ProductsIdsDto | CategoriesIdsDto
    public function attach(ProductsIdsDto $products, CategoriesIdsDto $categories): void
    {
        $this->products($products)->map(function (Product $product) use ($categories) {
            $product->categories()->withTimestamps()->attach($categories->categories);
        });
    }

    public function detach(ProductsIdsDto $products, CategoriesIdsDto $categories): void
    {
        $this->products($products)->map(function (Product $product) use ($categories) {
            $product->categories()->withTimestamps()->detach($categories->categories);
        });
    }

    protected function products(ProductsIdsDto $products): Collection
    {
        return Product::query()->whereIn('id', $products->products)->get();
    }
}
