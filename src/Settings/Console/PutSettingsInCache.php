<?php

namespace Quicktane\Core\Settings\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Quicktane\Core\Settings\Managers\SettingsManager;

class PutSettingsInCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'global-settings:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put settings in cache';

    /**
     * Execute the console command.
     */
    public function handle(SettingsManager $settingsManager)
    {
        $settingsManager->rememberCache();

        Log::info('Settings put in cache!');
    }
}
