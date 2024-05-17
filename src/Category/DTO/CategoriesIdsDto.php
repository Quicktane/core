<?php

namespace Quicktane\Core\Category\DTO;

use Quicktane\Core\Base\Dto;
use WendellAdriel\ValidatedDTO\Attributes\Rules;

class CategoriesIdsDto extends Dto
{
    #[Rules(['required', 'array', 'exists:qt_categories,id'])]
    public array $categories;
}
