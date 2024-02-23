<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\DepartementSeeder;
use Database\Seeders\MethodPaymentSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\SettingAppSeeder;
use Modules\Roles\database\seeders\RolesDatabaseSeeder;
use Modules\Users\database\seeders\UsersDatabaseSeeder;
use Modules\Warehouse\database\seeders\WarehouseDatabaseSeeder;
use Modules\Location\database\seeders\LocationDatabaseSeeder;
use Modules\Income\database\seeders\IncomeDatabaseSeeder;
use Modules\Expense\database\seeders\ExpenseDatabaseSeeder;
use Modules\Sales\database\seeders\SalesDatabaseSeeder;

class FreshInstall extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->call([
            SettingAppSeeder::class,
            PermissionSeeder::class,
            RolesDatabaseSeeder::class,
            UsersDatabaseSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            DepartementSeeder::class,
            MethodPaymentSeeder::class,
            WarehouseDatabaseSeeder::class,
            LocationDatabaseSeeder::class,
            IncomeDatabaseSeeder::class,
            ExpenseDatabaseSeeder::class,
            SalesDatabaseSeeder::class
        ]);
    }
}