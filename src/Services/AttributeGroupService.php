<?php

namespace Quicktane\Core\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Models\Attribute;
use Quicktane\Core\Models\AttributeGroup;

class AttributeGroupService
{
    public function attributesByGroup(array $groupIds): Collection
    {
        return $this->getAttributeGroups($groupIds)->mapWithKeys(
            fn(AttributeGroup $attributeGroup) => [$attributeGroup->slug => $attributeGroup->customAttributes]
        );
    }

    public function attributes(array $groupIds): AttributesCollection
    {
        return new AttributesCollection($this->attributesByGroup($groupIds)->collapse());
    }

    public function uniqueAttributes(array $groupIds): AttributesCollection
    {
        return $this->attributes($groupIds)->unique(fn(Attribute $attribute) => $attribute->slug);
    }

    public function getAttributeGroups(array $groupIds): Collection
    {
        return AttributeGroup::query()
            ->whereIn('id', $groupIds)
            ->with('customAttributes')
            ->get();
    }
}