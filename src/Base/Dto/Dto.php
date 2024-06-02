<?php

namespace Quicktane\Core\Base\Dto;

use Illuminate\Support\Collection;
use Quicktane\Core\Base\Dto\Concerns\EmptyCasts;
use Quicktane\Core\Base\Dto\Concerns\EmptyDefaults;
use Quicktane\Core\Base\Dto\Concerns\EmptyRules;

abstract class Dto extends ValidatedDTO
{
    use EmptyRules, EmptyCasts, EmptyDefaults;

    public function toCollection(): Collection
    {
        return new Collection($this->toArray());
    }
}
