<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Casting;

use Quicktane\Core\Base\Dto\Exceptions\CastException;

final class ObjectCast implements Castable
{
    /**
     * @throws CastException
     */
    public function cast(string $property, mixed $value): object
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        if (! is_array($value)) {
            throw new CastException($property);
        }

        return (object) $value;
    }
}
