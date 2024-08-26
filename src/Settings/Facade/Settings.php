<?php

namespace Quicktane\Core\Settings\Facade;

use Illuminate\Support\Facades\Facade;
use Quicktane\Core\Settings\Repositories\SettingsRepository;

/**
 * @method static float|object|string|array get(string $key)
 * @method static array all()
 *
 * @see SettingsRepository
 */
class Settings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'settings';
    }
}
