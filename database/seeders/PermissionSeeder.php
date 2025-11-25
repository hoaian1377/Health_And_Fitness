<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage_workouts',
            'manage_packages',
            'manage_promotions',
            'manage_users',
            'reply_chatbot',
        ];

        foreach ($permissions as $permission) 
        {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

    }
}
