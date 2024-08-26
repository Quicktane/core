<?php

namespace Quicktane\Core\Settings\Interfaces;

use Illuminate\Support\Collection;

interface SettingsServiceInterface
{
    public function all(): Collection;

    public function find(string $key);

    public function findOrFail(string $key);

    public function set(array $settings): void;

    public function delete(string $key): void;

    public function has(string $key): bool;
}
