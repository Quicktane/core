<?php

namespace Quicktane\Core\Services;

use Quicktane\Core\Dto\AttributeDto;
use Quicktane\Core\Models\Attribute;

class AttributesService
{
    public function find(int $id): ?Attribute
    {
        return Attribute::query()->find($id);
    }

    public function findBySlug(string $slug): ?Attribute
    {
        return Attribute::query()->where('slug', $slug)->first();
    }

    public function create(AttributeDto $dto): Attribute
    {
        $attribute = Attribute::query()->newModelInstance($dto->toArray());
        $attribute->save();

        return $attribute;
    }

    public function update(Attribute $attribute, AttributeDto $dto): Attribute
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