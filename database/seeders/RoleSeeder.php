<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminEmail =  'abs@gmail.com';

        // create super admin and assign existing permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superadminUser = \App\Models\User::whereEmail($superAdminEmail)->first() ?? \App\Models\User::factory()->create([
            'name' => 'ABS Infosys',
            'email' => $superAdminEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $superadminUser->assignRole($superAdmin);

        // permissions to admin
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin = Role::firstOrCreate(['name' => 'branch-admin']);

        $permissions = Permission::get();

        $superadminUser->syncPermissions($permissions);
    }
}
