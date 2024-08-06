<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Casting;

use Carbon\CarbonImmutable;
use Quicktane\Core\Base\Dto\Exceptions\CastException;
use Throwable;

final class CarbonImmutableCast implements Castable
{
    public function __construct(
        private ?string $timezone = null,
        private ?string $format = null
    ) {
    }

    /**
     * @throws CastException
     */
    public function cast(string $property, mixed $value): CarbonImmutable
    {
        try {
            return is_null($this->format)
                ? CarbonImmutable::parse($value, $this->timezone)
                : CarbonImmutable::createFromFormat($this->format, $value, $this->timezone);
        } catch (Throwable) {
            throw new CastException($property);
        }
    }
}
