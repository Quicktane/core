<?php

namespace Quicktane\Core\Category\Services;


use Illuminate\Support\Facades\DB;
use Quicktane\Core\Category\DTO\CategoryTree;
use Quicktane\Core\Category\Models\Category;

class CategoryService
{
    public function listTree()
    {
        return Category::query()->get()->toTree()->toArray();
    }

    public function rebuildTree(CategoryTree $categoriesTree): void
    {
        DB::transaction(function () use ($categoriesTree) {
            Category::rebuildTree($categoriesTree->toArray());
        });
    }
}
