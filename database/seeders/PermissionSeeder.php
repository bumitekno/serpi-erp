<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);

        //module roles
        $permission_module_roles = [
            'create-role',
            'edit-role',
            'delete-role',
        ];

        // Looping and Inserting Array's Permissions Module Roles into Permission Table
        foreach ($permission_module_roles as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'roles', 'group_modules' => 'user']);
        }

        //module user 
        $permissions_module_user = [
            'create-user',
            'edit-user',
            'delete-user',
        ];

        // Looping and Inserting Array's Permissions Module Users into Permission Table
        foreach ($permissions_module_user as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'users', 'group_modules' => 'user']);
        }

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

        //module method Payment
        /*
        $permissions_module_method_payment = [
            'create-method-payment',
            'edit-method-payment',
            'delete-method-payment'
        ];

        // Looping and Inserting Array's Permissions Module Method Payment into Permission Table
        foreach ($permissions_module_method_payment as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'method_payment', 'group_modules' => 'master']);
        }*/

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

        /** report module */
        $permissions_module_report = [
            'report-daily-pos'
        ];
        // Looping and Inserting Array's Permissions Module Method Payment into Permission Table
        foreach ($permissions_module_report as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'reportpos', 'group_modules' => 'report']);
        }
    }
}
