<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleUserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $trainerRole = Role::where('name', 'trainer')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );

        $trainer = User::firstOrCreate(
            ['email' => 'trainer@example.com'],
            ['name' => 'Trainer', 'password' => bcrypt('password')]
        );

        $normal = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'User', 'password' => bcrypt('password')]
        );

        // Gán role
        $admin->assignRole($adminRole);
        $trainer->assignRole($trainerRole);
        $normal->assignRole($userRole);



    }
}
