<?php

namespace Quicktane\Core\Config\Services;

use BackedEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Config\Dto\ConfigDto;
use Quicktane\Core\Config\Models\Config;

class ConfigService
{
    public function __construct(
        protected ConfigCacheService $configCacheService
    ) {
    }

    const PREFIX = 'global_configs';

    public function all(): Collection
    {
        return Config::query()->get();
    }

    public function find(BackedEnum $key): Config|null
    {
        return Config::query()->where(['key' => $key->value])->first();
    }

    public function findOrFail(BackedEnum $key): Config|null
    {
        //TODO do we need add custom exception?
        return Config::query()->where(['key' => $key->value])->firstOrFail();
    }

    public function get(BackedEnum $key)
    {
        return $this->configCacheService->get($key, $this->find($key)->value);
    }

    public function getOrFail(BackedEnum $key)
    {
        return $this->configCacheService->get($key, $this->findOrFail($key)->value);
    }

    public function set(ConfigDto $configDto): Config
    {
        return DB::transaction(function () use ($configDto) {
            $config = $configDto->toModel(Config::class);

            $config->save();

            $this->configCacheService->put($configDto->key, $configDto->value);

            return $config;
        });
    }

    public function saveInCache(): void
    {
        $this->all()->each(fn(Config $config) => $this->configCacheService->put($config->key, $config->value));
    }

    public function delete(BackedEnum $key): void
    {
        DB::transaction(function () use ($key) {
            Config::query()->where('key', $key);

            $this->configCacheService->delete($key);
        });
    }

    public function has(BackedEnum $key): bool
    {
        return Config::query()->where(['key' => $key->value])->exists();
    }
}
