<?php

namespace Quicktane\Core\Product\Managers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Product\Dto\CreateAttributeDto;
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

            if ($attributeDto->type->hasOptions() && $options->isNotEmpty()) {
                $this->attributeOptionService->createMany($attribute, $options);
            }

            return $attribute;
        });
    }

    public function update(CreateAttributeDto $attributeDto, Collection $options = null): Attribute
    {
        return DB::transaction(function () use ($attributeDto, $options) {
            $attribute = $this->attributeService->create($attributeDto);

            if ($options->isNotEmpty()) {
                $this->attributeOptionService->createMany($attribute, $options);
            }

            return $attribute;
        });
    }

    public function delete(Attribute $attribute)
    {

    }
}