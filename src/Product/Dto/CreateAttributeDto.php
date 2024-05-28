<?php

namespace Quicktane\Core\Product\Dto;

use Illuminate\Validation\Rules\Enum;
use Quicktane\Core\Base\Dto;
use Quicktane\Core\Product\Enums\AttributeType;
use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\DefaultValue;
use WendellAdriel\ValidatedDTO\Attributes\Rules;
use WendellAdriel\ValidatedDTO\Casting\EnumCast;
use WendellAdriel\ValidatedDTO\Casting\IntegerCast;

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
