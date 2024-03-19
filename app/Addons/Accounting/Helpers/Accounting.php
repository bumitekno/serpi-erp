<?php
namespace App\Addons\Accounting\Helpers;

use Artisan;
use App\Addons\Accounting\Models\account_account;
use App\Addons\Accounting\Models\account_journal;

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

    /**
     * The function `account_account` retrieves account data ordered by code in ascending order.
     * 
     * @return  `account_account` function is returning a collection of account records ordered by the
     * `code` column in ascending order.
     */

    public static function account_account()
    {
        $account = account_account::orderBy('code', 'asc')->get();
        return $account;
    }


    /**
     * This PHP function retrieves account journal entries ordered by code in ascending order.
     * 
     * @return  `account_journal` entries are being retrieved from the database, ordered by the
     * `code` field in ascending order, and returned as a collection.
     */

    public static function account_journal()
    {
        $journal = account_journal::orderBy('code', 'asc')->get();
        return $journal;
    }
}