<?php
namespace App\Addons\Accounting\Illuminate;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class AccountingRoutersProvider extends ServiceProvider
{
    protected $namespace = '\App\Addons\Accounting\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }


    protected function mapApiRoutes()
    {
        Route::prefix('Accounting\api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/api.php');
    }

    protected function mapWebRoutes()
    {
        Route::prefix('Accounting')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../Routes/web.php');
    }
}