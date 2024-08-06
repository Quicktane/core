<?php

namespace Quicktane\Core\Product\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Product\Dto\ConfigurableProductDto;
use Quicktane\Core\Product\Dto\ProductDto;
use Quicktane\Core\Product\Enums\ProductType;
use Quicktane\Core\Product\Models\Product;

readonly class ProductService
{
    public function __construct(
        protected AttributeGroupService $attributeGroupService,
        protected ProductAttributesService $productAttributesService
    ) {
    }

    public function createSimpleProduct(ProductDto $dto): Product
    {
        return $this->create($dto);
    }

    public function creteConfigurableProduct(ConfigurableProductDto $dto): Product
    {
        return DB::transaction(function () use ($dto) {
            $configurableProduct = $this->create($dto->product, ProductType::CONFIGURABLE);
            $configurableProduct->save();

            $configurableProduct->variantOptions()->attach($dto->configurable_options->attribute_options);

            //todo add creation of variants (??maybe through queue??)

            return $configurableProduct;
        });
    }

    public function createVariant(ProductDto $dto): Product
    {
        return $this->create($dto, ProductType::VARIANT);
    }

    public function create(ProductDto $dto, ProductType $type = ProductType::SIMPLE): Product
    {
        return DB::transaction(function () use ($dto, $type) {
            $this->attributeGroupService->assertExists($dto->attribute_group_id);

            /** @var Product $product */
            $product = $dto->toModel(Product::class);
            $product->attributeGroup()->associate($dto->attribute_group_id);
            $product->type = $type;
            // todo change it to enum
            $product->status = 'active';
            $product->save();

            $attributes = new AttributesCollection($product->attributeGroup->customAttributes);
            $attributeValues = Arr::only($dto->attributes, $attributes->attributeKeys()->toArray());

            $this->productAttributesService->saveValues($product, $attributes, $attributeValues);

            return $product;
        });
    }

    public function update(Product $product, ProductDto $dto): Product
    {
        return DB::transaction(function () use ($product, $dto) {
            $this->attributeGroupService->assertExists($dto->attribute_group_id);

            $product->fill($dto->toArray());
            $product->attributeGroup()->associate($dto->attribute_group_id);
            $product->save();

            $attributes = new AttributesCollection($product->attributeGroup->customAttributes);
            $attributeValues = Arr::only($dto->attributes, $attributes->attributeKeys()->toArray());

            $this->productAttributesService->saveValues($product, $attributes, $attributeValues);

            return $product;
        });
    }
}
