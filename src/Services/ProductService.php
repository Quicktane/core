<?php

namespace Quicktane\Core\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Dto\ProductDto;
use Quicktane\Core\Models\Product;

readonly class ProductService
{
    public function __construct(
        protected AttributeGroupService $attributeGroupService,
        protected ProductAttributesService $productAttributesService
    ) {
    }

    public function create(ProductDto $dto): Product
    {
        return DB::transaction(function () use ($dto) {
            $this->attributeGroupService->assertExists($dto->getAttributeGroup());

            $product = Product::query()->newModelInstance($dto->toArray());
            $product->attributeGroup()->associate($dto->getAttributeGroup());
            // todo change it to enum
            $product->status = 'active';
            $product->save();

            $attributes = new AttributesCollection($product->attributeGroup->customAttributes);
            $attributeValues = Arr::only($dto->getAttributes(), $attributes->attributeKeys()->toArray());

            $this->productAttributesService->saveValues($product, $attributes, $attributeValues);

            return $product;
        });
    }

    public function update(Product $product, ProductDto $dto): Product
    {
        return DB::transaction(function () use ($product, $dto) {
            $this->attributeGroupService->assertExists($dto->getAttributeGroup());

            $product->fill($dto->toArray());
            $product->attributeGroup()->associate($dto->getAttributeGroup());
            // todo change it to enum
            $product->status = 'active';
            $product->save();

            $attributes = new AttributesCollection($product->attributeGroup->customAttributes);
            $attributeValues = Arr::only($dto->getAttributes(), $attributes->attributeKeys()->toArray());

            $this->productAttributesService->saveValues($product, $attributes, $attributeValues);

            return $product;
        });
    }
}