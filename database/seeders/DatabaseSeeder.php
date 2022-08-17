<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);//ejecutar seeder

        $user = User::create([
            'dni' => "1234",
            'apellido_paterno' => 'admin',
            'apellido_materno' => 'admin',
            'nombres'=> 'nombres',
            'password' => Hash::make('1234'),
        ]);

        $user->assignRole('administrador');

    }
}
