<?php

namespace Quicktane\Core\Product\Dto;

use Quicktane\Core\Base\Dto\Attributes\Cast;
use Quicktane\Core\Base\Dto\Attributes\DefaultValue;
use Quicktane\Core\Base\Dto\Attributes\Exclude;
use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Casting\IntegerCast;
use Quicktane\Core\Base\Dto\Dto;

class ProductDto extends Dto
{
    #[Rules(['required', 'string'])]
    public string $sku;

    #[Rules(['sometimes', 'integer'])]
    #[Cast(IntegerCast::class)]
    #[DefaultValue(0)]
    public int $quantity;

    #[Rules(['required', 'integer', 'exists:qt_attribute_groups,id'])]
    public int $attribute_group_id;

    #[Rules(['required', 'array'])]
    #[Exclude]
    public array $attributes = [];
}
