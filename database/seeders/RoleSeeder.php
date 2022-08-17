<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create(['name' => 'usuario']);
        $role2 = Role::create(['name' => 'administrador']);

        $permission = Permission::create(['name' => 'usuario'])->assignRole($role1);
        $permission2 = Permission::create(['name' => 'adminstrador'])->assignRole($role2);
    }
}
