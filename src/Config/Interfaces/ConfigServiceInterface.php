<?php

namespace Quicktane\Core\Config\Interfaces;

use BackedEnum;
use Illuminate\Support\Collection;

interface ConfigServiceInterface
{
    public function all(): Collection;

    public function find(BackedEnum $key);

    public function findOrFail(BackedEnum $key);

    public function set(array $config): void;

    public function delete(BackedEnum $key): void;

    public function has(BackedEnum $key): bool;
}
