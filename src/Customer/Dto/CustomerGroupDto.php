<?php

namespace Quicktane\Core\Customer\Dto;

use Quicktane\Core\Base\Dto\Attributes\Cast;
use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Casting\BooleanCast;
use Quicktane\Core\Base\Dto\Dto;

class CustomerGroupDto extends Dto
{
    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $name;

    #[Rules(['nullable', 'string', 'min:3', 'max:255'])]
    public ?string $slug;

    #[Rules(['nullable', 'bool'])]
    #[Cast(BooleanCast::class)]
    public ?bool $default;

    public function defaults(): array
    {
        return [
            'default' => false,
        ];
    }

    public function asDefault(): static
    {
        return new static(array_merge($this->toArray(), ['default' => true]));
    }
}
