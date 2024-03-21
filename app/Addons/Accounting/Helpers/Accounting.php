<?php
namespace App\Addons\Accounting\Helpers;

use Artisan;


class Accounting
{
    /**
     * The "installed" function in PHP runs database migrations, clears cache, and seeds data for an
     * accounting addon.
     */
    public static function installed()
    {
        Artisan::call('migrate', array('--path' => 'app/Addons/Accounting/Migrations', '--force' => true));
        Artisan::call('cache:forget spatie.permission.cache');
        Artisan::call('cache:clear');
        Artisan::call('db:seed --class=AccountingInstallSeeder');
    }

    /**
     * The function `uninstalled` rolls back migrations, clears cache, and forgets permissions cache in a
     * Laravel application.
     * 
     * @return `If an exception is caught during the execution of the code inside the `try` block, the
     * `uninstalled()` function will return `false`.
     */
    public static function uninstalled()
    {
        try {
            Artisan::call('migrate:rollback', array('--path' => 'app/Addons/Accounting/Migrations', '--force' => true));
            Artisan::call('cache:forget spatie.permission.cache');
            Artisan::call('cache:clear');
        } catch (\Exception $e) {
            return false;
        }
    }

}