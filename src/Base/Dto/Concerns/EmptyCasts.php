<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Concerns;

trait EmptyCasts
{
    public function casts(): array
    {
        return [];
    }
}
