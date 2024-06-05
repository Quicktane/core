<?php

namespace Quicktane\Core\Product\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Product\Dto\CreateAttributeDto;
use Quicktane\Core\Product\Dto\UpdateAttributeDto;
use Quicktane\Core\Product\Models\Attribute;
use Quicktane\Core\Product\Services\AttributeOptionService;
use Quicktane\Core\Product\Services\AttributeService;

class AttributeManager
{
    public function __construct(
        protected AttributeService $attributeService,
        protected AttributeOptionService $attributeOptionService,
    ) {
    }

    public function create(CreateAttributeDto $attributeDto, Collection $options = null): Attribute
    {
        return DB::transaction(function () use ($attributeDto, $options) {
            $attribute = $this->attributeService->create($attributeDto);

            if ($attributeDto->type->hasOptions() && $options && $options->isNotEmpty()) {
                $this->attributeOptionService->createMany($attribute, $options);
            }

            return $attribute;
        });
    }

    public function update(
        Attribute $attribute,
        UpdateAttributeDto $attributeDto,
        Collection $options = null
    ): Attribute {
        return DB::transaction(function () use ($attribute, $attributeDto, $options) {
            $attribute = $this->attributeService->update($attribute, $attributeDto);

            if ($attribute->type->hasOptions() && $options && $options->isNotEmpty()) {
                //todo add update options
//                $this->attributeOptionService->createMany($attribute, $options);
            }

            return $attribute;
        });
    }

    public function delete(Attribute $attribute)
    {

    }
}
