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

        Permission::firstOrCreate(['name' => 'salary_*']);
        Permission::firstOrCreate(['name' => 'salary_payment']);

        Permission::firstOrCreate(['name' => 'project_*']);
        Permission::firstOrCreate(['name' => 'project_create']);
        Permission::firstOrCreate(['name' => 'project_edit']);
        Permission::firstOrCreate(['name' => 'project_delete']);

        Permission::firstOrCreate(['name' => 'assign_project_*']);
        Permission::firstOrCreate(['name' => 'assign_project_create']);
        Permission::firstOrCreate(['name' => 'assign_project_edit']);
        Permission::firstOrCreate(['name' => 'assign_project_delete']);

        Permission::firstOrCreate(['name' => 'role_*']);
        Permission::firstOrCreate(['name' => 'role_create']);
        Permission::firstOrCreate(['name' => 'role_edit']);
        Permission::firstOrCreate(['name' => 'role_delete']);

        Permission::firstOrCreate(['name' => 'country_*']);
        Permission::firstOrCreate(['name' => 'country_create']);
        Permission::firstOrCreate(['name' => 'country_edit']);
        Permission::firstOrCreate(['name' => 'country_delete']);

        Permission::firstOrCreate(['name' => 'province_*']);
        Permission::firstOrCreate(['name' => 'province_create']);
        Permission::firstOrCreate(['name' => 'province_edit']);
        Permission::firstOrCreate(['name' => 'province_delete']);

        Permission::firstOrCreate(['name' => 'report_purchase']);
        Permission::firstOrCreate(['name' => 'report_inventory']);
        Permission::firstOrCreate(['name' => 'report_sales']);

        Permission::firstOrCreate(['name' => 'purchase_*']);
        Permission::firstOrCreate(['name' => 'purchase_create']);
        Permission::firstOrCreate(['name' => 'purchase_edit']);
        Permission::firstOrCreate(['name' => 'purchase_delete']);

        Permission::firstOrCreate(['name' => 'supplier_*']);
        Permission::firstOrCreate(['name' => 'supplier_create']);
        Permission::firstOrCreate(['name' => 'supplier_edit']);
        Permission::firstOrCreate(['name' => 'supplier_delete']);

        Permission::firstOrCreate(['name' => 'sales_*']);
        Permission::firstOrCreate(['name' => 'sales_create']);
        Permission::firstOrCreate(['name' => 'sales_edit']);
        Permission::firstOrCreate(['name' => 'sales_delete']);

        Permission::firstOrCreate(['name' => 'sales_return_*']);
        Permission::firstOrCreate(['name' => 'sales_return_create']);
        Permission::firstOrCreate(['name' => 'sales_return_edit']);
        Permission::firstOrCreate(['name' => 'sales_return_delete']);

        Permission::firstOrCreate(['name' => 'customer_*']);
        Permission::firstOrCreate(['name' => 'customer_create']);
        Permission::firstOrCreate(['name' => 'customer_edit']);
        Permission::firstOrCreate(['name' => 'customer_delete']);

        Permission::firstOrCreate(['name' => 'product_*']);
        Permission::firstOrCreate(['name' => 'product_create']);
        Permission::firstOrCreate(['name' => 'product_edit']);
        Permission::firstOrCreate(['name' => 'product_delete']);

        Permission::firstOrCreate(['name' => 'category_*']);
        Permission::firstOrCreate(['name' => 'category_create']);
        Permission::firstOrCreate(['name' => 'category_edit']);
        Permission::firstOrCreate(['name' => 'category_delete']);

        Permission::firstOrCreate(['name' => 'brand_*']);
        Permission::firstOrCreate(['name' => 'brand_create']);
        Permission::firstOrCreate(['name' => 'brand_edit']);
        Permission::firstOrCreate(['name' => 'brand_delete']);
    }
}
