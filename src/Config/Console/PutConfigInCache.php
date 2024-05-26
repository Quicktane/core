<?php

namespace Quicktane\Core\Config\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Quicktane\Core\Config\Services\ConfigService;

class PutConfigInCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'global-config:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put config in cache';

    /**
     * Execute the console command.
     */
    public function handle(ConfigService $configService)
    {
        $configService->saveInCache();

        Log::info('Config put in cache!');
    }
}
