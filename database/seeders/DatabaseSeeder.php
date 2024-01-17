<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Roles\database\seeders\RolesDatabaseSeeder;
use Modules\Roles\database\seeders\PermissionSeeder;
use Modules\Users\database\seeders\UsersDatabaseSeeder;
use Modules\ProductPos\database\seeders\ProductPosDatabaseSeeder;
use Modules\CategoryProduct\database\seeders\CategoryProductDatabaseSeeder;
use Modules\UnitProduct\database\seeders\UnitProductDatabaseSeeder;
use Modules\Warehouse\database\seeders\WarehouseDatabaseSeeder;
use Modules\Stock\database\seeders\StockDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RolesDatabaseSeeder::class,
            UsersDatabaseSeeder::class,
            CategoryProductDatabaseSeeder::class,
            ProductPosDatabaseSeeder::class,
            UnitProductDatabaseSeeder::class,
            WarehouseDatabaseSeeder::class,
            StockDatabaseSeeder::class
        ]);
    }
}
