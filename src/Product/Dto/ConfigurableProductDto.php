<?php

namespace Quicktane\Core\Product\Dto;

use Quicktane\Core\Base\Dto\Attributes\Cast;
use Quicktane\Core\Base\Dto\Attributes\Rules;
use Quicktane\Core\Base\Dto\Casting\DTOCast;
use Quicktane\Core\Base\Dto\Dto;

class ConfigurableProductDto extends Dto
{
    #[Rules(['required', 'array'])]
    #[Cast(DTOCast::class, ProductDto::class)]
    public ProductDto $product;

    #[Rules(['required', 'array'])]
    #[Cast(DtoCast::class, ConfigurableProductOptionsDto::class)]
    public ConfigurableProductOptionsDto $configurable_options;
}
