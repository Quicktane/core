<?php

namespace Quicktane\Core\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Quicktane\Core\Dto\CustomerGroupDto;
use Quicktane\Core\Models\CustomerGroup;

class CustomerGroupService
{
    public function create(CustomerGroupDto $dto): CustomerGroup
    {
        $slug = $dto->slug ?? $this->generateSlug($dto->name);

        $this->assertSlugUnique($slug);

        $customerGroup = CustomerGroup::query()->newModelInstance($dto->toArray());
        $customerGroup->slug = $slug;
        $customerGroup->save();

        return $customerGroup;
    }

    public function update(CustomerGroup $customerGroup, CustomerGroupDto $dto): CustomerGroup
    {
        $slug = $dto->slug ?? $this->generateSlug($dto->name);

        $this->assertSlugUnique($slug, $customerGroup->slug);

        $customerGroup->fill($dto->toArray());
        $customerGroup->slug = $slug;
        $customerGroup->save();

        return $customerGroup;
    }

    public function delete(CustomerGroup $customerGroup): bool
    {
        return $customerGroup->delete();
    }

    public function assertSlugUnique(string $slug, string $except = null): void
    {
        if ($this->isSlugExists($slug, $except)) {
            throw new \Exception("Customer group slug [$slug] already exists.");
        }
    }

    public function isSlugExists(string $slug, string $except = null): bool
    {
        return CustomerGroup::query()
            ->where('slug', $slug)
            ->when($except, fn(Builder $query) => $query->where('slug', '!=', $except))
            ->exists();
    }

    protected function generateSlug(string $name): string
    {
        return Str::slug($name);
    }
}