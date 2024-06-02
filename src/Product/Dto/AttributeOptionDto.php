<?php

namespace Quicktane\Core\Product\Dto;

use Quicktane\Core\Base\Dto\Attributes\Cast;
use Quicktane\Core\Base\Dto\Attributes\DefaultValue;
use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Casting\BooleanCast;
use Quicktane\Core\Base\Dto\Casting\IntegerCast;
use Quicktane\Core\Base\Dto\Dto;

class AttributeOptionDto extends Dto
{
    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $name;

    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $slug;

    #[Rules(['nullable', 'bool'])]
    #[Cast(BooleanCast::class)]
    #[DefaultValue(false)]
    public mixed $default;

    #[Rules(['sometimes', 'integer'])]
    #[Cast(IntegerCast::class)]
    #[DefaultValue(0)]
    public int $position;
}
