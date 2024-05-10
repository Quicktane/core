<?php

namespace Quicktane\Core\Dto;

use Quicktane\Core\Base\Dto;
use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\Rules;
use WendellAdriel\ValidatedDTO\Casting\BooleanCast;

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
