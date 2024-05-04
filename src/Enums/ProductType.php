<?php

namespace Quicktane\Core\Enums;

enum ProductType: string
{
    case SIMPLE = 'simple';
    case CONFIGURABLE = 'configurable';

    case VARIANT = 'variant';
}