<?php

namespace Quicktane\Core\Settings\Managers;

use BackedEnum;
use Quicktane\Core\Settings\Repositories\SettingsCacheRepository;
use Quicktane\Core\Settings\Repositories\SettingsRepository;

class SettingsManager
{
    public function __construct(
        protected SettingsCacheRepository $settingsCacheService,
        protected SettingsRepository $settingsRepository,
    ) {
    }

    public function putInCacheIfExist(?BackedEnum $key = null): void
    {
        if ($key == null || $this->settingsRepository->find($key)) {
            $this->rememberCache();
        }
    }

    public function rememberCache(): void
    {
        $this->settingsCacheService->forgetCache();

        $this->settingsCacheService->rememberStructure($this->getSerializedSettingsForCache());
    }

    protected function getSerializedSettingsForCache(): array
    {
        return $this->settingsRepository->all()->toArray();
    }
}
