<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AddonsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        require_once app_path() . '/Helpers/Addons.php';
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // auto register service providers
        $filesystem = $this->app->make('files');
        foreach ($filesystem->directories(app_path('Addons')) as $directory) {
            $directoryName = last(explode('/', $directory));
            $this->app->register("App\\Addons\\{$directoryName}\\Illuminate\\{$directoryName}ServiceProvider");
        }
    }
}
