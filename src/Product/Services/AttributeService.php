<?php

namespace Quicktane\Core\Product\Services;

use Quicktane\Core\Product\Dto\CreateAttributeDto;
use Quicktane\Core\Product\Models\Attribute;

class AttributeService
{
    public function __construct(
        protected AttributeOptionService $attributeOptionService
    ) {
    }

    public function find(int $id): ?Attribute
    {
        return Attribute::query()->find($id);
    }

    public function findBySlug(string $slug): ?Attribute
    {
        return Attribute::query()->where('slug', $slug)->first();
    }

    public function create(CreateAttributeDto $dto): Attribute
    {
        /** @var Attribute $attribute */
        $attribute = $dto->toModel(Attribute::class);
        $attribute->save();

        return $attribute;
    }

    public function update(Attribute $attribute, CreateAttributeDto $dto): Attribute
    {
        $attribute->fill($dto->toArray());
        $attribute->save();

        return $attribute;
    }

    public function delete(Attribute $attribute): bool
    {
        return $attribute->delete();
    }
}
