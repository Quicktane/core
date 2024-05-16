<?php

namespace Quicktane\Core\Category\DTO;

use Quicktane\Core\Base\Dto;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class ProductsIdsDto extends Dto
{
    #[Rules(['required', 'array', 'exists:qt_products,id'])]
    public array $products;
}
