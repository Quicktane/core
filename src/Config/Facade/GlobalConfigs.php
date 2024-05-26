<?php

namespace Quicktane\Core\Config\Facade;

use BackedEnum;
use Illuminate\Support\Facades\Facade;

/**
 * @method static float|object|string|array get(BackedEnum $key)
 * @method static array list()
 *
 * @see ConfigService
 */
class GlobalConfigs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'global_configs';
    }
}
