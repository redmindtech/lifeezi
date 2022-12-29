<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
     $user = User::create([
         'name' => 'Admin',
         'email' => 'admin@gmail.com',
         'password' => Hash::make('Password1!')
     ]);
     $user->assignRole('Admin');
     $permissions = Permission::all();
     $user->givePermissionTo($permissions);
    }
}
