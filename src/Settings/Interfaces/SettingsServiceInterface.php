<?php

namespace Quicktane\Core\Settings\Interfaces;

use BackedEnum;
use Illuminate\Support\Collection;

interface SettingsServiceInterface
{
    public function all(): Collection;

    public function find(BackedEnum $key);

    public function findOrFail(BackedEnum $key);

    public function set(array $settings): void;

    public function delete(BackedEnum $key): void;

    public function has(BackedEnum $key): bool;
}
