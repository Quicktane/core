<?php

namespace Quicktane\Core\Services;

use Quicktane\Core\Models\Product;

class ProductQueryService
{
    public function find(int $id): ?Product
    {
        return Product::query()->find($id);
    }

    public function findBySku(string $sku): ?Product
    {
        return Product::query()->where('sku', $sku)->first();
    }

    public function all()
    {
        return Product::query()->get();
    }
}