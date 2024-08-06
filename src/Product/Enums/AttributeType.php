<?php

namespace Quicktane\Core\Product\Enums;

enum AttributeType: string
{
    case STRING = 'string';
    case DATE = 'date';
    case DATETIME = 'datetime';
    case BOOLEAN = 'boolean';
    case SELECT = 'select';
    case MULTI_SELECT = 'multi_select';
    case IMAGE = 'image';

    public function hasOptions(): bool
    {
        return match ($this) {
            self::SELECT,
            self::MULTI_SELECT => true,
            default            => false
        };
    }
}