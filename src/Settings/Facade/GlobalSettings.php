<?php

namespace Quicktane\Core\Settings\Facade;

use BackedEnum;
use Illuminate\Support\Facades\Facade;
use Quicktane\Core\Settings\Repositories\SettingsRepository;

/**
 * @method static float|object|string|array get(BackedEnum $key)
 * @method static array all()
 *
 * @see SettingsRepository
 */
class GlobalSettings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'global_settings';
    }
}
