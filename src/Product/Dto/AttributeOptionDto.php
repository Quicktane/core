<?php

namespace Quicktane\Core\Product\Dto;

use Quicktane\Core\Base\Dto;
use WendellAdriel\ValidatedDTO\Attributes\Cast;
use WendellAdriel\ValidatedDTO\Attributes\DefaultValue;
use WendellAdriel\ValidatedDTO\Attributes\Rules;
use WendellAdriel\ValidatedDTO\Casting\BooleanCast;
use WendellAdriel\ValidatedDTO\Casting\IntegerCast;

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
