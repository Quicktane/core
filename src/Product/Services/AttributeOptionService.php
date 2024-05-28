<?php

namespace Quicktane\Core\Product\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Product\Dto\AttributeOptionDto;
use Quicktane\Core\Product\Models\Attribute;
use Quicktane\Core\Product\Models\AttributeOption;

class AttributeOptionService
{
    public function findBySlug(string $slug): ?AttributeOption
    {
        return AttributeOption::query()->where('slug', $slug)->first();
    }

    public function createMany(Attribute $attribute, Collection $attributeOptions): Collection
    {
        return $attributeOptions->map(
            fn(AttributeOptionDto $dto) => $this->create($attribute, $dto)
        );
    }

    public function create(Attribute $attribute, AttributeOptionDto $dto): AttributeOption
    {
        $attributeOption = $dto->toModel(AttributeOption::class);
        $attributeOption->attribute()->associate($attribute);
        $attributeOption->save();

        return $attributeOption;
    }

    public function update(AttributeOption $attributeOption, AttributeOptionDto $dto): AttributeOption
    {
        $attributeOption->fill($dto->toArray());
        $attributeOption->save();

        return $attributeOption;
    }

    public function delete(AttributeOption $attribute): bool
    {
        return $attribute->delete();
    }
}