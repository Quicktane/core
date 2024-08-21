<?php

namespace Quicktane\Core\Settings\Repositories;

use BackedEnum;
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

    public function find(BackedEnum $key): ?string
    {
        return Settings::query()->where(['key' => $key->value])->first()?->value;
    }

    public function findOrFail(BackedEnum $key): string|SettingsNotFoundException|null
    {
        try {
            return Settings::query()->where(['key' => $key->value])->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            throw  new SettingsNotFoundException($key);
        }
    }

    public function has(BackedEnum $key): bool
    {
        return Settings::query()->where(['key' => $key->value])->exists();
    }

    public function set(array $settings): void
    {
        DB::transaction(function () use ($settings) {
            $settings = new Settings($settings);

            $settings->save();

            return $settings;
        });
    }

    public function delete(BackedEnum $key): void
    {
        DB::transaction(function () use ($key) {
            Settings::query()->where('key', $key)->delete();
        });
    }
}
