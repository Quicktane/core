<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Casting;

use Quicktane\Core\Base\Dto\Exceptions\CastException;
use Throwable;

final class StringCast implements Castable
{
    /**
     * @throws CastException
     */
    public function cast(string $property, mixed $value): string
    {
        try {
            return (string) $value;
        } catch (Throwable) {
            throw new CastException($property);
        }
    }
}
