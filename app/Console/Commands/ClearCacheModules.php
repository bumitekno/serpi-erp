<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class ClearCacheModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-cache-modules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Cache Modules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        Event::listen('Illuminate\Console\Events\CommandStarting', function ($event) { // or CommandFinished
            if ($event->command == 'optimize:clear') {
                File::delete(File::glob('bootstrap/cache/*_module.php'));
            }
        });
    }
}
