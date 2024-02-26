<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\DepartementSeeder;
use Database\Seeders\MethodPaymentSeeder;
use Database\Seeders\SupplierSeeder;
use Modules\ProductPos\database\seeders\ProductPosDatabaseSeeder;
use Modules\CategoryProduct\database\seeders\CategoryProductDatabaseSeeder;
use Modules\UnitProduct\database\seeders\UnitProductDatabaseSeeder;
use Modules\Warehouse\database\seeders\WarehouseDatabaseSeeder;
use Modules\Location\database\seeders\LocationDatabaseSeeder;
use Modules\Income\database\seeders\IncomeDatabaseSeeder;
use Modules\Expense\database\seeders\ExpenseDatabaseSeeder;
use Modules\Sales\database\seeders\SalesDatabaseSeeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PostInstallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->call([
            CustomerSeeder::class,
            DepartementSeeder::class,
            LocationDatabaseSeeder::class,
            SupplierSeeder::class,
            MethodPaymentSeeder::class,
            CategoryProductDatabaseSeeder::class,
            ProductPosDatabaseSeeder::class,
            UnitProductDatabaseSeeder::class,
            WarehouseDatabaseSeeder::class,
            IncomeDatabaseSeeder::class,
            ExpenseDatabaseSeeder::class,
            SalesDatabaseSeeder::class,
        ]);

        $this->permission_drop();
        $this->permission_add();
    }

    /** permission modules */

    public function permission_add()
    {

        //module master 
        $permissions_module_customer = [
            'create-customer',
            'edit-customer',
            'delete-customer'
        ];

        // Looping and Inserting Array's Permissions Module customer into Permission Table
        foreach ($permissions_module_customer as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'customer', 'group_modules' => 'master']);
        }

        // module supplier
        $permissions_module_supplier = [
            'create-supplier',
            'edit-supplier',
            'delete-supplier'
        ];

        // Looping and Inserting Array's Permissions Module supplier into Permission Table
        foreach ($permissions_module_supplier as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'supplier', 'group_modules' => 'master']);
        }

        //module departement
        $permissions_module_departement = [
            'create-departement',
            'edit-departement',
            'delete-departement'
        ];

        // Looping and Inserting Array's Permissions Module supplier into Permission Table
        foreach ($permissions_module_departement as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'departement', 'group_modules' => 'master']);
        }


        //module product
        $permissions_module_product = [
            'create-product',
            'edit-product',
            'delete-product',
            'import-product',
            'export-product',
            'download-product'
        ];

        // Looping and Inserting Array's Permissions Module product into Permission Table
        foreach ($permissions_module_product as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'product', 'group_modules' => 'inventory']);
        }

        // module category product
        $permission_module_category = [
            'create-category-product',
            'edit-category-product',
            'delete-category-product',
        ];

        // Looping and Inserting Array's Permissions Module Category Product  into Permission Table
        foreach ($permission_module_category as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'category_product', 'group_modules' => 'inventory']);
        }

        // module unit product
        $permission_module_unit = [
            'create-unit-product',
            'edit-unit-product',
            'delete-unit-product',
        ];

        // Looping and Inserting Array's Permissions Module Category Product  into Permission Table
        foreach ($permission_module_unit as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'unit_product', 'group_modules' => 'inventory']);
        }

        //module location
        $permission_module_location = [
            'create-location',
            'edit-location',
            'delete-location',
        ];

        // Looping and Inserting Array's Permissions Module Category Product  into Permission Table
        foreach ($permission_module_location as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'location', 'group_modules' => 'inventory']);
        }

        //module warehouse
        $permission_module_warehouse = [
            'create-warehouse',
            'edit-warehouse',
            'delete-warehouse',
        ];

        // Looping and Inserting Array's Permissions Module Category Product  into Permission Table
        foreach ($permission_module_warehouse as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'warehouse', 'group_modules' => 'inventory']);
        }


        //module stock
        $permission_module_stock = [
            'create-stock',
            'edit-stock',
            'delete-stock',
            'import-stock',
            'export-stock'
        ];

        foreach ($permission_module_stock as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'stock', 'group_modules' => 'inventory']);
        }


        //module purchase
        $permission_module_purchase = [
            'create-purchase',
            'edit-purchase',
            'delete-purchase',
            'download-purchase',
            'dashboard-purchase',
            'report-purchase'
        ];

        foreach ($permission_module_purchase as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'purchase', 'group_modules' => 'purchase']);
        }

        //module sales
        $permission_module_sales = [
            'create-sales',
            'edit-sales',
            'delete-sales',
            'download-sales',
            'dashboard-sales',
            'report-sales'
        ];
        foreach ($permission_module_sales as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'sales', 'group_modules' => 'sales']);
        }

        //premission module income 
        $permission_module_income = [
            'create-income',
            'edit-income',
            'delete-income',
            'create-transaction-income',
            'edit-transaction-income',
            'delete-transaction-income'
        ];

        foreach ($permission_module_income as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'income', 'group_modules' => 'income']);
        }

        //premission module income 
        $permission_module_expense = [
            'create-expense',
            'edit-expense',
            'delete-expense',
            'create-transaction-expense',
            'edit-transaction-expense',
            'delete-transaction-expense'
        ];

        foreach ($permission_module_expense as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'expense', 'group_modules' => 'expense']);
        }

        // permission report 
        Permission::create(['name' => 'report-daily-pos', 'guard_name' => 'web', 'module' => 'reportposdaily', 'group_modules' => 'report']);
        Permission::create(['name' => 'report-shipment', 'guard_name' => 'web', 'module' => 'reportshipment', 'group_modules' => 'report']);
        Permission::create(['name' => 'statistic', 'guard_name' => 'web', 'module' => 'statistic', 'group_modules' => 'statistic']);

        $roles_superadmin = Role::where(['name' => 'Superadmin', 'guard_name' => 'web'])->first();
        $permissions = Permission::all()->pluck('id')->toArray();
        $roles_superadmin->syncPermissions($permissions);

    }

    public function permission_drop()
    {
        Permission::where('group_modules', 'master')->delete();
        Permission::where('group_modules', 'inventory')->delete();
        Permission::where('group_modules', 'purchase')->delete();
        Permission::where('group_modules', 'sales')->delete();
        Permission::where('group_modules', 'income')->delete();
        Permission::where('group_modules', 'expense')->delete();
        Permission::where('group_modules', 'report')->delete();
        Permission::where('group_modules', 'statistic')->delete();
    }
}
