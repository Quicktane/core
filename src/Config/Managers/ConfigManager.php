<?php

namespace Quicktane\Core\Config\Managers;

use BackedEnum;
use Quicktane\Core\Config\Services\ConfigCacheService;
use Quicktane\Core\Config\Services\ConfigService;

class ConfigManager
{
    public function __construct(
        protected ConfigCacheService $configCacheService,
        protected ConfigService $configService,
    ) {
    }

    public function putInCacheIfExist(?BackedEnum $key = null): void
    {
        if ($key == null || $this->configService->find($key)) {
            $this->rememberCache();
        }
    }

    public function rememberCache(): void
    {
        $this->configCacheService->forgetCache();

        $this->configCacheService->rememberStructure($this->getSerializedConfigsForCache());
    }

    protected function getSerializedConfigsForCache(): array
    {
        return $this->configService->all()->toArray();
    }
}
