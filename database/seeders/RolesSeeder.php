<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $role_superadmin = Role::create(['name' => 'superadmin']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_digitador = Role::create(['name' => 'digitador']);


        $permission_crear = Permission::create(['name' => 'crear pacientes']);
        $permission_modificar = Permission::create(['name' => 'modificar pacientes']);
        $permission_ver = Permission::create(['name' => 'ver pacientes']);
        $permission_eliminar = Permission::create(['name' => 'eliminar pacientes']);
        $permission_crear2 = Permission::create(['name' => 'crear usuarios']);
        $permission_modificar2 = Permission::create(['name' => 'modificar usuarios']);
        $permission_ver2 = Permission::create(['name' => 'ver usuarios']);
        $permission_eliminar2 = Permission::create(['name' => 'eliminar usuarios']);


        $permissions_superadmin = [$permission_crear, $permission_crear2, $permission_modificar, $permission_modificar2, $permission_ver, $permission_ver2, $permission_eliminar, $permission_eliminar2];
        $permissions_admin = [$permission_crear, $permission_modificar, $permission_ver, $permission_eliminar];
        $permissions_digitador = [$permission_crear, $permission_ver];

        $role_superadmin->syncPermissions($permissions_superadmin);
        $role_admin->syncPermissions($permissions_admin);
        $role_digitador->syncPermissions($permissions_digitador);
        // we will add more to this in a second
    }
}
