<?php

declare(strict_types=1);

namespace Quicktane\Core\Base\Dto\Concerns;

trait EmptyRules
{
    public function rules(): array
    {
        return [];
    }
}
