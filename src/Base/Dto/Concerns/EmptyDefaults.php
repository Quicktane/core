<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Concerns;

trait EmptyDefaults
{
    public function defaults(): array
    {
        return [];
    }
}
