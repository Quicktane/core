<?php

namespace Quicktane\Core\Settings\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Quicktane\Core\Settings\Exceptions\SettingsNotFoundException;
use Quicktane\Core\Settings\Models\Settings;

class SettingsRepository
{
    public function all(): Collection
    {
        return Settings::query()
                       ->select(['key', 'value'])
                       ->get()
                       ->mapWithKeys(fn(Settings $settings) => [$settings->key => $settings->value]);
    }

    public function find(string $key): ?string
    {
        return Settings::query()->where(['key' => $key])->first()?->value;
    }

    public function findOrFail(string $key): string|SettingsNotFoundException|null
    {
        try {
            return Settings::query()->where(['key' => $key])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw  new SettingsNotFoundException($key);
        }
    }

    public function has(string $key): bool
    {
        return Settings::query()->where(['key' => $key])->exists();
    }

    public function set(array $settings): void
    {
        DB::transaction(function () use ($settings) {
            $settings = new Settings($settings);

            $settings->save();

            return $settings;
        });
    }

    public function delete(string $key): void
    {
        DB::transaction(function () use ($key) {
            Settings::query()->where('key', $key)->delete();
        });
    }
}
