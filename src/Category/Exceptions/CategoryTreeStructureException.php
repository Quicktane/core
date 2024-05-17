<?php

namespace Quicktane\Core\Category\Exceptions;

use Exception;

class CategoryTreeStructureException extends Exception
{
    public function __construct()
    {
        parent::__construct("Incorrect structure");
    }
}
