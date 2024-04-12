<?php

namespace Quicktane\Core;

use Illuminate\Support\ServiceProvider;

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
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'quicktane');

        collect($this->configFiles)->each(function ($config) {
            $this->mergeConfigFrom(__DIR__."/../config/$config.php", "quicktane.$config");
        });
    }

    public function boot()
    {
        if (! config('quicktane.database.disable_migrations', false)) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        collect($this->configFiles)->each(function ($config) {
            $this->publishes([
                __DIR__."/../config/$config.php" => config_path("quicktane/$config.php"),
            ], 'quicktane');
        });

        $this->publishes([
            __DIR__.'/../resources/lang' => lang_path('vendor/lunar'),
        ], 'quicktane.translation');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ]);
    }
}