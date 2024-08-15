<?php

namespace Quicktane\Core\Config\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Quicktane\Core\Base\Factories\CacheFactory;

class ConfigCacheRepository
{
    const PREFIX = 'global_configs';

    public function __construct(
        protected CacheFactory $cacheFactory
    ) {
    }

    public function all(): Collection
    {
        return collect($this->cacheFactory->driver()->get($this->cachePrefix()));
    }

    public function get($key, $default = null): ?string
    {
        return Arr::get($this->cacheFactory->driver()->get($this->cachePrefix()), $key->value, $default);
    }

    public function rememberStructure(array $cache): void
    {
        $this->cacheFactory->driver()->set($this->cachePrefix(), $cache);
    }

    public function forgetCache(): void
    {
        $this->cacheFactory->driver()->forget($this->cachePrefix());
    }

    public function cachePrefix(): string
    {
        return self::PREFIX;
    }
}
