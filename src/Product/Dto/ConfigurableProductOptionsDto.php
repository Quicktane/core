<?php

namespace Quicktane\Core\Product\Dto;

use Quicktane\Core\Base\Dto\Dto;

class ConfigurableProductOptionsDto extends Dto
{
    public array $attribute_options;

    public function rules(): array
    {
        return [
            'attribute_options'   => 'required|array',
            'attribute_options.*' => 'required|integer|exists:qt_attribute_options,id',
        ];
    }
}
