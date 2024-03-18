<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReportDailyPosController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/auth/checkpost', [AuthController::class, 'Authen'])->name('loginprocess');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('module/{module}', [HomeController::class, 'checkroute'])->middleware('auth')->name('checkroute');
    Route::get('/statistic', [HomeController::class, 'statistic'])->middleware('auth')->name('statistic');
    Route::prefix('addons')->group(function () {
        Route::get('/', [HomeController::class, 'Addons'])->name('home.addons');
        Route::post('/', [HomeController::class, 'Addons'])->name('home.addons');
        Route::get('/install/{id}', [HomeController::class, 'install'])->name('home.install_addons');
        Route::get('/uninstall/{id}', [HomeController::class, 'uninstall'])->name('home.uninstall_addons');
    })->middleware('auth');
});

Route::prefix('report')->group(function () {
    Route::prefix('dailypost')->group(function () {
        Route::get('index', [ReportDailyPosController::class, 'index'])->name('report.dailypost');
        Route::get('export/dailypos', [ReportDailyPosController::class, 'downloadreportD'])->name('report.downloadreportD');
    });
    Route::prefix('shipments')->group(function () {
        Route::get('index', [ShipmentController::class, 'index'])->name('report.shipment');
        Route::post('store', [ShipmentController::class, 'store'])->name('report.storeshipment');
    });
})->middleware('auth');

Route::prefix('profil')->group(function () {
    Route::get('index', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('storeupdate', [ProfilController::class, 'storeupdate'])->name('profil.storeupdate');
})->middleware('auth');

Route::prefix('system')->group(function () {
    Route::prefix('log-activity')->group(function () {
        Route::get('index', [SystemController::class, 'index'])->name('log-activity.index');
        Route::get('delete/{id}', [SystemController::class, 'destroy'])->name('log-activity.destroy');
        Route::get('force/delete/all', [SystemController::class, 'removeAllActivity'])->name('log-activity.removeAllActivity');
    });
    Route::prefix('settings')->group(function () {
        Route::get('index', [SystemController::class, 'settingApps'])->name('settings.settingApps');
        Route::post('index', [SystemController::class, 'settingStore'])->name('settings.settingStore');
        Route::get('backup', [SystemController::class, 'backupdatabase'])->name('settings.backupdatabase');
        Route::get('download/backup/{filename}', [SystemController::class, 'download'])->name('settings.downloadbackup');
        Route::post('upload/restore/database', [SystemController::class, 'restoredatabase'])->name('settings.restoredatabase');
        Route::get('reset/trans/all', [SystemController::class, 'reset_trans'])->name('systems.reset_trans');
        Route::get('reset/data/master', [SystemController::class, 'reset_datamaster'])->name('systems.reset_datamaster');
    });
})->middleware('auth');