<?php

namespace Quicktane\Core\Config\Exceptions;

use BackedEnum;
use Exception;

class ConfigNotFoundException extends Exception
{
    public function __construct(BackedEnum $config)
    {
        parent::__construct("Config `$config->value` not found");
    }
}
