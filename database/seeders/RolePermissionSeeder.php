<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
       $admin = Role::where('name', 'admin')->first();
        $trainer = Role::where('name', 'trainer')->first();

        // ADMIN có tất cả quyền
        $admin->givePermissionTo(Permission::all());

        // TRAINER có 1 quyền
        $trainer->givePermissionTo('manage_workouts');

    }
}
