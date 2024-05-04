<?php

namespace Quicktane\Core\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Models\Attribute;
use Quicktane\Core\Models\Product;
use Quicktane\Core\Models\ProductAttributeValue;

readonly class ProductService
{
    public function __construct(
        protected AttributeGroupService $attributeGroupService
    ) {
    }

    //todo move all attribute logic to AttributeService
    public function create(array $productAttributes): Product
    {
        return DB::transaction(function () use ($productAttributes) {
            $attributeGroupIds = Arr::pull($productAttributes, 'attribute_groups');
            $rawAttributes = Arr::pull($productAttributes, 'attributes');

            /** @var Product $product */
            $product = Product::query()->newModelInstance($productAttributes);
            $product->save();

            $product->attributeGroups()->sync($attributeGroupIds);

            $customAttributes = $this->attributeGroupService->uniqueAttributes($attributeGroupIds);

            //todo ??? do we need to store attributes or just attributes groups ???
//        $product->customAttributes()->sync($customAttributes->pluck('id'));

            $customAttributeValues = Arr::only($rawAttributes, $customAttributes->attributeKeys()->toArray());

            //todo add check for required attributes and also add validation
            $customAttributes->each(function (Attribute $attribute) use ($product, $customAttributeValues) {
                $attributeValue = ProductAttributeValue::query()->newModelInstance([
                    'value' => $customAttributeValues[$attribute->slug] ?? null,
                ]);
                $attributeValue->attribute()->associate($attribute);
                $attributeValue->product()->associate($product);
                $attributeValue->save();
            });

            return $product;
        });
    }
}