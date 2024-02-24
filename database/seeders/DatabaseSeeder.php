<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\DepartementSeeder;
use Database\Seeders\MethodPaymentSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\AddonsSeeder;
use Database\Seeders\SettingAppSeeder;
use Modules\Roles\database\seeders\RolesDatabaseSeeder;
use Modules\Users\database\seeders\UsersDatabaseSeeder;
use Modules\ProductPos\database\seeders\ProductPosDatabaseSeeder;
use Modules\CategoryProduct\database\seeders\CategoryProductDatabaseSeeder;
use Modules\UnitProduct\database\seeders\UnitProductDatabaseSeeder;
use Modules\Warehouse\database\seeders\WarehouseDatabaseSeeder;
use Modules\Location\database\seeders\LocationDatabaseSeeder;
use Modules\Income\database\seeders\IncomeDatabaseSeeder;
use Modules\Expense\database\seeders\ExpenseDatabaseSeeder;
use Modules\Sales\database\seeders\SalesDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddonsSeeder::class,
            SettingAppSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            DepartementSeeder::class,
            LocationDatabaseSeeder::class,
            MethodPaymentSeeder::class,
            PermissionSeeder::class,
            RolesDatabaseSeeder::class,
            UsersDatabaseSeeder::class,
            CategoryProductDatabaseSeeder::class,
            ProductPosDatabaseSeeder::class,
            UnitProductDatabaseSeeder::class,
            WarehouseDatabaseSeeder::class,
            IncomeDatabaseSeeder::class,
            ExpenseDatabaseSeeder::class,
            SalesDatabaseSeeder::class,
        ]);
    }
}
