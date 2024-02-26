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

        //permission system
        Permission::create(['name' => 'log-activity', 'guard_name' => 'web', 'module' => 'log-activity', 'group_modules' => 'system']);
        Permission::create(['name' => 'setting-aplication', 'guard_name' => 'web', 'module' => 'setting-aplication', 'group_modules' => 'system']);
    }
}
