<?php

namespace Quicktane\Core\Product\Dto;

use Illuminate\Validation\Rules\Enum;
use Quicktane\Core\Base\Dto\Attributes\Cast;
use Quicktane\Core\Base\Dto\Attributes\DefaultValue;
use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Casting\EnumCast;
use Quicktane\Core\Base\Dto\Casting\IntegerCast;
use Quicktane\Core\Base\Dto\Dto;
use Quicktane\Core\Product\Enums\AttributeType;

class CreateAttributeDto extends Dto
{
    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $name;

    #[Rules(['required', 'string', 'min:3', 'max:255'])]
    public string $slug;

    #[Rules(['required', new Enum(AttributeType::class)])]
    #[Cast(EnumCast::class, AttributeType::class)]
    public AttributeType $type;

    #[Rules(['nullable'])]
    public mixed $default_value = null;

    #[Rules(['sometimes', 'integer'])]
    #[Cast(IntegerCast::class)]
    #[DefaultValue(0)]
    public int $position = 0;
}
