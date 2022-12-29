<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        $permissions = $this->getPermissions();
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        $role = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'Employee']);
        $permission = Permission::where('name','admin.read')->first();
        $role->givePermissionTo($permission);
        $permission->assignRole($role);
        $permission = Permission::where('name','admin.read_write')->first();
        $role->givePermissionTo($permission);
        $permission->assignRole($role);
        $permissionUser = $this->getEmployeePermission();
        foreach ($permissionUser as $permission) {
            Permission::create($permission);
        }
        $permissionsUser = Permission::where('name','employee.read')->first();
        $roleUser->givePermissionTo($permissionsUser);
        $permissionsUser->assignRole($roleUser);
        $permissionsUser = Permission::where('name','employee.read_write')->first();
        $roleUser->givePermissionTo($permissionsUser);
        $permissionsUser->assignRole($roleUser);

    }

    public function getPermissions() {
        return[
            ['name' => 'admin.read', 'guard_name'=>'web'],
            ['name' => 'admin.read_write','guard_name' => 'web'],
        ];
    }

    public function getEmployeePermission() {
        return[
            ['name' => 'employee.read', 'guard_name'=>'web'],
            ['name' => 'employee.read_write','guard_name' => 'web']
        ];
    }
}
