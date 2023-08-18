<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'fiscalYear_*']);
        Permission::firstOrCreate(['name' => 'fiscalYear_create']);
        Permission::firstOrCreate(['name' => 'fiscalYear_edit']);
        Permission::firstOrCreate(['name' => 'fiscalYear_delete']);

        Permission::firstOrCreate(['name' => 'tax_*']);
        Permission::firstOrCreate(['name' => 'tax_create']);
        Permission::firstOrCreate(['name' => 'tax_edit']);
        Permission::firstOrCreate(['name' => 'tax_delete']);

        Permission::firstOrCreate(['name' => 'branch_*']);
        Permission::firstOrCreate(['name' => 'branch_create']);
        Permission::firstOrCreate(['name' => 'branch_edit']);
        Permission::firstOrCreate(['name' => 'branch_delete']);

        Permission::firstOrCreate(['name' => 'employee_*']);
        Permission::firstOrCreate(['name' => 'employee_create']);
        Permission::firstOrCreate(['name' => 'employee_edit']);
        Permission::firstOrCreate(['name' => 'employee_delete']);

        Permission::firstOrCreate(['name' => 'schedule_*']);
        Permission::firstOrCreate(['name' => 'schedule_create']);
        Permission::firstOrCreate(['name' => 'schedule_edit']);
        Permission::firstOrCreate(['name' => 'schedule_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);

        Permission::firstOrCreate(['name' => 'unit_*']);
        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);
    }
}
