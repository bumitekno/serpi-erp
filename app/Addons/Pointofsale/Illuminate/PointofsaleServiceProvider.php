<?php

namespace App\Addons\Pointofsale\Illuminate;

use Illuminate\Support\ServiceProvider;

class PointofsaleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Addons/Pointofsale/Helpers/Pointofsale.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
