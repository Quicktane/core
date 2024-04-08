<?php

namespace Quicktane;

use Illuminate\Support\ServiceProvider;

class QuicktaneServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'quicktane');
    }

    public function boot()
    {
        if (! config('quicktane.database.disable_migrations', false)) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ]);
    }
}