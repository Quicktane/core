<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Casting;

use Quicktane\Core\Base\Dto\Exceptions\CastException;

final class FloatCast implements Castable
{
    /**
     * @throws CastException
     */
    public function cast(string $property, mixed $value): float
    {
        if (! is_numeric($value)) {
            throw new CastException($property);
        }

        return (float) $value;
    }
}
