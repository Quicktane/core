<?php

namespace Quicktane\Core\Config\Services;

use BackedEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Config\Dto\ConfigDto;
use Quicktane\Core\Config\Models\Config;

class ConfigService
{
    const PREFIX = 'global_configs';

    public function list(): Collection
    {
        return Config::query()->get();
    }

    public function find(BackedEnum $key): Config|null
    {
        return Config::query()->where(['key' => $key->value])->first();
    }

    public function get(BackedEnum $key)
    {
        // todo add exception if config doesnt exists
        return Cache::get($this->cachePrefix($key), $this->find($key)->value);
    }

    public function set(ConfigDto $configDto): Config
    {
        return DB::transaction(function () use ($configDto) {
            $config = Config::query()->newModelInstance($configDto->toArray());

            $config->save();

            Cache::put($this->cachePrefix($configDto->key), $configDto->value);

            return $config;
        });
    }

    public function delete(string $key): void
    {
        DB::transaction(function () use ($key) {
            Config::query()->where('key', $key);

            Cache::delete($this->cachePrefix($key));
        });
    }

    public function has(BackedEnum $key): bool
    {
        return Config::query()->where(['key' => $key->value])->exists();
    }

    public function saveInCache(): void
    {
        Config::query()->each(fn(Config $config) => Cache::put($this->cachePrefix($config->key), $config->value));
    }

    private function cachePrefix(BackedEnum|string $key): string
    {
        return self::PREFIX . ':' . (is_string($key) ? $key : $key->value);
    }
}
