<?php
namespace App\Addons\Pointofsale\Helpers;

use Artisan;


class Pointofsale
{
    /**
     * The function runs database migrations, clears cache, and seeds data after installation.
     */
    public static function installed()
    {
        Artisan::call('migrate', array('--path' => 'app/Addons/Pointofsale/Migrations', '--force' => true));
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:clear');
        Artisan::call('db:seed --class=PostInstallSeeder');
    }

    /**
     * The function `uninstalled` rolls back migrations, clears cache, and forgets spatie permission
     * cache in PHP.
     * 
     * @return `If an exception is caught during the execution of the `uninstalled` function, `false`
     * will be returned.
     */
    public static function uninstalled()
    {
        try {
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Pointofsale/Migrations', '--force' => true));
            Artisan::call('cache:forget spatie.permission.cache');
            Artisan::call('cache:clear');
        } catch (\Exception $e) {
            return false;
        }
    }
}