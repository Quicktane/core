<?php

namespace Quicktane\Core\Config\Services;

use BackedEnum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Config\Exceptions\ConfigNotFoundException;
use Quicktane\Core\Config\Models\Config;

class ConfigRepository
{
    public function all(): Collection
    {
        return Config::query()
                     ->select(['key', 'value'])
                     ->get()
                     ->mapWithKeys(fn(Config $config) => [$config->key => $config->value]);
    }

    public function find(BackedEnum $key): ?string
    {
        return Config::query()->where(['key' => $key->value])->first()?->value;
    }

    public function findOrFail(BackedEnum $key): string|ConfigNotFoundException|null
    {
        try {
            return Config::query()->where(['key' => $key->value])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw  new ConfigNotFoundException($key);
        }
    }

    public function has(BackedEnum $key): bool
    {
        return Config::query()->where(['key' => $key->value])->exists();
    }

    public function set(array $config): void
    {
        DB::transaction(function () use ($config) {
            $config = new Config($config);

            $config->save();

            return $config;
        });
    }

    public function delete(BackedEnum $key): void
    {
        DB::transaction(function () use ($key) {
            Config::query()->where('key', $key)->delete();
        });
    }
}
