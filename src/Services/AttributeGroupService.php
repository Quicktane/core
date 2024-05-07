<?php

namespace Quicktane\Core\Services;

use Quicktane\Core\Dto\AttributeGroupDto;
use Quicktane\Core\Models\AttributeGroup;

class AttributeGroupService
{
    public function create(AttributeGroupDto $dto): AttributeGroup
    {
        $attributeGroup = AttributeGroup::query()->newModelInstance($dto->toArray());
        $attributeGroup->save();

        $attributeGroup->customAttributes()->attach($dto->getAttributes());

        return $attributeGroup;
    }

    public function update(AttributeGroup $attributeGroup, AttributeGroupDto $dto): AttributeGroup
    {
        $attributeGroup = $attributeGroup->fill($dto->toArray());
        $attributeGroup->save();

        $attributeGroup->customAttributes()->sync($dto->getAttributes());

        return $attributeGroup;
    }

    public function delete(AttributeGroup $attributeGroup): bool
    {
        return $attributeGroup->delete();
    }

    public function assertExists(int $attributeGroupId): void
    {
        if (!$this->exists($attributeGroupId)) {
            //todo create custom exception
            throw new \Exception('Selected attribute group does not exist');
        }
    }

    public function exists(int $attributeGroupId): bool
    {
        return AttributeGroup::query()->where('id', $attributeGroupId)->exists();
    }
}