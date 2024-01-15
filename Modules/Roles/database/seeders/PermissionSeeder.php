<?php

namespace Modules\Roles\database\seeders;

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
            'download-purchase'
        ];

        foreach ($permission_module_purchase as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'purchase', 'group_modules' => 'purchase']);
        }

        //module sales
        $permission_module_sales = [
            'create-sales',
            'edit-sales',
            'delete-sales',
            'download-sales'
        ];

        foreach ($permission_module_sales as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'sales', 'group_modules' => 'sales']);
        }

    }
}
