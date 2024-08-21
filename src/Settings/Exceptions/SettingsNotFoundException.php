<?php

namespace Quicktane\Core\Settings\Exceptions;

use BackedEnum;
use Exception;

class SettingsNotFoundException extends Exception
{
    public function __construct(BackedEnum $settings)
    {
        parent::__construct("Config `$settings->value` not found");
    }
}
