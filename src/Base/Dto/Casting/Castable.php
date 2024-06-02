<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Casting;

interface Castable
{
    public function cast(string $property, mixed $value): mixed;
}
