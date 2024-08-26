<?php

namespace Quicktane\Core\Settings\Managers;

use Quicktane\Core\Settings\Repositories\SettingsCacheRepository;
use Quicktane\Core\Settings\Repositories\SettingsRepository;

class SettingsManager
{
    public function __construct(
        protected SettingsCacheRepository $settingsCacheService,
        protected SettingsRepository $settingsRepository,
    ) {
    }

    public function putInCacheIfExist(?string $key = null): void
    {
        if ($key == null || $this->settingsRepository->find($key)) {
            $this->refreshCache();
        }
    }

    public function refreshCache(): void
    {
        $this->settingsCacheService->forgetCache();

        $this->settingsCacheService->refreshStructure($this->getSerializedSettingsForCache());
    }

    protected function getSerializedSettingsForCache(): array
    {
        return $this->settingsRepository->all()->toArray();
    }
}
