<?php

namespace Quicktane\Core\Category\DTO;

use Exception;
use Illuminate\Support\Arr;
use Quicktane\Core\Category\Exceptions\CategoryTreeStructureException;

class CategoryTree
{
    public array $categoriesTree = [];

    public function __construct(
        protected array $rawCategories
    ) {
    }

    public static function fromArray(array $rawCategories): static
    {
        $categoryTree = new self($rawCategories);

        return $categoryTree->build();
    }

    public function build(): static
    {
        try {
            $this->categoriesTree = Arr::map(
                $this->rawCategories,
                fn(array $rawCategory) => $this->parseCategory($rawCategory)
            );

            return $this;
        } catch (Exception $exception) {
            throw new CategoryTreeStructureException();
        }
    }

    public function parseCategory($category): array
    {
        $parsedItem = [];
        foreach ($category as $key => $value) {
            if ($key === 'children' && is_array($value)) {
                $parsedItem[$key][] = $this->parseCategory($value);
            } else {
                $parsedItem[$key] = $value;
            }
        }

        return $parsedItem;
    }

    public function toArray(): array
    {
        return $this->categoriesTree;
    }
}