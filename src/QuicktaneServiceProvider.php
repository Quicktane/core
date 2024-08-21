<?php

namespace Quicktane\Core;

use Illuminate\Support\ServiceProvider;
use Quicktane\Core\Console\Commands\Import\ImportCountries;
use Quicktane\Core\Settings\Console\PutSettingsInCache;
use Quicktane\Core\Settings\Interfaces\SettingsServiceInterface;
use Quicktane\Core\Settings\Repositories\SettingsRepository;
use Quicktane\Core\Settings\Services\SettingsService;

class QuicktaneServiceProvider extends ServiceProvider
{
    protected array $configFiles = [
        'cart',
        'database',
        'media',
        'orders',
        'payments',
        'pricing',
        'search',
        'shipping',
        'taxes',
        'urls',
    ];

    public function register()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'quicktane');

        collect($this->configFiles)->each(function ($config) {
            $this->mergeConfigFrom(__DIR__ . "/../config/$config.php", "quicktane.$config");
        });

        $this->app->bind('global_configs', fn() => new SettingsRepository());
        $this->app->bind(SettingsServiceInterface::class, fn() => resolve(SettingsService::class));
    }

    public function boot()
    {
        $this->commands([
            ImportCountries::class,
            PutSettingsInCache::class,
        ]);

        if (!config('quicktane.database.disable_migrations', false)) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }

        collect($this->configFiles)->each(function ($config) {
            $this->publishes([
                __DIR__ . "/../config/$config.php" => config_path("quicktane/$config.php"),
            ], 'quicktane');
        });

        $this->publishes([
            __DIR__ . '/../resources/lang' => lang_path('vendor/lunar'),
        ], 'quicktane.translation');

        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);
    }
}
