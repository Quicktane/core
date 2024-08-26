<?php

namespace Quicktane\Core\Settings\Services;

use Illuminate\Support\Collection;
use Quicktane\Core\Settings\Interfaces\SettingsServiceInterface;
use Quicktane\Core\Settings\Managers\SettingsManager;
use Quicktane\Core\Settings\Repositories\SettingsCacheRepository;
use Quicktane\Core\Settings\Repositories\SettingsRepository;

class SettingsService extends SettingsRepository implements SettingsServiceInterface
{
    public function __construct(
        protected SettingsCacheRepository $settingsCacheRepository,
        protected SettingsRepository $settingsRepository,
        protected SettingsManager $settingsManager,
    ) {
    }

    public function all(): Collection
    {
        $result = $this->settingsCacheRepository->all();

        if ($result->isNotEmpty()) {
            return $result;
        }

        $this->settingsManager->putInCacheIfExist();

        return parent::all();
    }

    public function find(string $key): string
    {
        $settings = $this->settingsCacheRepository->get($key);

        if (!is_null($settings)) {
            return $settings;
        }

        $this->settingsManager->putInCacheIfExist($key);

        return parent::find($key);
    }

    public function findOrFail(string $key): string
    {
        $settings = $this->settingsCacheRepository->get($key);

        if (!is_null($settings)) {
            return $settings;
        }

        $this->settingsManager->putInCacheIfExist($key);

        return parent::find($key);
    }

    public function set(array $settings): void
    {
        parent::set($settings);

        $this->settingsManager->refreshCache();
    }

    public function delete(string $key): void
    {
        parent::delete($key);

        $this->settingsManager->refreshCache();
    }
}
