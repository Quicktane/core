<?php

namespace Quicktane\Core\Config\Decorators;

use BackedEnum;
use Illuminate\Support\Collection;
use Quicktane\Core\Config\Dto\ConfigDto;
use Quicktane\Core\Config\Interfaces\ConfigServiceInterface;
use Quicktane\Core\Config\Services\ConfigCacheService;
use Quicktane\Core\Config\Services\ConfigService;

class ConfigDecorator extends ConfigService implements ConfigServiceInterface
{
    public function __construct(
        protected ConfigService $configService,
        protected ConfigCacheService $configCacheService,
    ) {
    }

    public function all(): Collection
    {
        $result = $this->configCacheService->all();

        if ($result->isNotEmpty()) {
            return $result;
        }

        $this->putInCacheIfExist();

        return parent::all();
    }

    public function find(BackedEnum $key): string
    {
        $config = $this->configCacheService->get($key);

        if (!is_null($config)) {
            return $config;
        }

        $this->putInCacheIfExist($key);

        return parent::find($key);
    }

    public function findOrFail(BackedEnum $key): string
    {
        $config = $this->configCacheService->get($key);

        if (!is_null($config)) {
            return $config;
        }

        $this->putInCacheIfExist($key);

        return parent::find($key);
    }

    public function set(ConfigDto $configDto): void
    {
        parent::set($configDto);

        $this->rememberCache();
    }

    public function delete(BackedEnum $key): void
    {
        parent::delete($key);

        $this->rememberCache();
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
