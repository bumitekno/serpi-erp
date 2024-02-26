<?php
namespace App\Addons\Pointofsale\Helpers;

use Artisan;


class Pointofsale
{
    public static function installed()
    {
        Artisan::call('migrate', array('--path' => 'app/Addons/Pointofsale/Migrations', '--force' => true));
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:clear');
        Artisan::call('db:seed --class=PostInstallSeeder');
    }

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