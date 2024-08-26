<?php

namespace Quicktane\Core\Settings\Exceptions;

use Exception;

class SettingsNotFoundException extends Exception
{
    public function __construct(string $settings)
    {
        parent::__construct("Config `$settings` not found");
    }
}
