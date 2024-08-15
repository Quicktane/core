<?php

namespace Quicktane\Core\Config\Managers;

use BackedEnum;
use Quicktane\Core\Config\Services\ConfigCacheRepository;
use Quicktane\Core\Config\Services\ConfigRepository;

class ConfigManager
{
    public function __construct(
        protected ConfigCacheRepository $configCacheService,
        protected ConfigRepository $configService,
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
