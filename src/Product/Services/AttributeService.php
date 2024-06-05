<?php

namespace Quicktane\Core\Product\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Quicktane\Core\Product\Dto\CreateAttributeDto;
use Quicktane\Core\Product\Dto\UpdateAttributeDto;
use Quicktane\Core\Product\Models\Attribute;

class AttributeService
{
    public function find(int $id): ?Attribute
    {
        return Attribute::query()->find($id);
    }

    public function list(): LengthAwarePaginator
    {
        return Attribute::query()->paginate();
    }

    public function collection(): Collection
    {
        return Attribute::query()->get();
    }

    public function findBySlug(string $slug): ?Attribute
    {
        return Attribute::query()->where('slug', $slug)->first();
    }

    public function create(CreateAttributeDto $dto): Attribute
    {
        $slug = $dto->slug ?? Str::slug($dto->name);

        //todo add method exist($slug)
        if ($this->findBySlug($slug)) {
            //todo add custom exception with status code 409
            throw new \Exception("Attribute with slug [$slug] already exists");
        }

        /** @var Attribute $attribute */
        $attribute = $dto->toModel(Attribute::class);
        $attribute->slug = $dto->slug ?? Str::slug($dto->name);
        $attribute->save();


        return $attribute;
    }

    public function update(Attribute $attribute, UpdateAttributeDto $dto): Attribute
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
