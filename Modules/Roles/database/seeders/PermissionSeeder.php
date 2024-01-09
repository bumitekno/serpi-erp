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

        $permission_module_roles = [
            'create-role',
            'edit-role',
            'delete-role',
        ];

        // Looping and Inserting Array's Permissions Module Roles into Permission Table
        foreach ($permission_module_roles as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'roles']);
        }

        $permissions_module_user = [
            'create-user',
            'edit-user',
            'delete-user',
        ];

        // Looping and Inserting Array's Permissions Module Users into Permission Table
        foreach ($permissions_module_user as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'users']);
        }

        $permissions_module_product = [
            'create-product',
            'edit-product',
            'delete-product'
        ];

        // Looping and Inserting Array's Permissions Module Users into Permission Table
        foreach ($permissions_module_product as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web', 'module' => 'product']);
        }
    }
}
