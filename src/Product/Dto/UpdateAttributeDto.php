<?php

namespace Quicktane\Core\Product\Dto;

use Quicktane\Core\Base\Dto\Attributes\Cast;
use Quicktane\Core\Base\Dto\Attributes\DefaultValue;
use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Casting\IntegerCast;
use Quicktane\Core\Base\Dto\Dto;

class UpdateAttributeDto extends Dto
{
    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $name;

    #[Rules(['nullable'])]
    public mixed $default_value = null;

    #[Rules(['sometimes', 'integer'])]
    #[Cast(IntegerCast::class)]
    #[DefaultValue(0)]
    public int $position = 0;
}
