<?php

namespace Quicktane\Core\Product\Enums;

enum ProductType: string
{
    case SIMPLE = 'simple';
    case CONFIGURABLE = 'configurable';

    case VARIANT = 'variant';
}