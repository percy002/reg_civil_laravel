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

        $permission = Permission::create(['name' => 'observador'])->syncRoles([$role1,$role2]);
        $permission = Permission::create(['name' => 'editor'])->assignRole($role2);
        $permission2 = Permission::create(['name' => 'administrador'])->assignRole($role2);
        
        
    }
}
