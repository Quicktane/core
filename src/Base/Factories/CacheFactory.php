<?php

namespace Quicktane\Core\Base\Factories;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\CacheInterface;

class CacheFactory
{
    public function driver(): CacheInterface
    {
        return Cache::driver(config('quicktane_cache.cache_driver'));
    }
}
