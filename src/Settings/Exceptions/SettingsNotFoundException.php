<?php

namespace Quicktane\Core\Settings\Exceptions;

use BackedEnum;
use Exception;

class SettingsNotFoundException extends Exception
{
    public function __construct(BackedEnum $config)
    {
        parent::__construct("Config `$config->value` not found");
    }
}
