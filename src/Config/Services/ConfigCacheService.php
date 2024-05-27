<?php

namespace Quicktane\Core\Config\Services;

use BackedEnum;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\CacheInterface;

class ConfigCacheService
{
    const PREFIX = 'global_configs';

    public function get(BackedEnum $key, $default = null)
    {
        return $this->cacheDriver()->get($this->cachePrefix($key), $default);
    }

    public function put(BackedEnum|string $key, $value)
    {
        return $this->cacheDriver()->put($this->cachePrefix($this->resolveKey($key)), $value);
    }

    public function delete(BackedEnum $key)
    {
        return $this->cacheDriver()->delete($this->cachePrefix($key));
    }

    public function has(BackedEnum $key): bool
    {
        return $this->cacheDriver()->has($this->cachePrefix($key->value));
    }

    protected function cachePrefix(BackedEnum|string $key): string
    {
        return self::PREFIX . ':' . $this->resolveKey($key);
    }

    protected function resolveKey(BackedEnum|string $key): string
    {
        return match (true) {
            is_string($key)            => $key,
            $key instanceof BackedEnum => $key->value,
            default                    => $key
        };
    }

    protected function cacheDriver(): CacheInterface
    {
        return Cache::driver();
    }
}
