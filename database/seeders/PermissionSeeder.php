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
        Permission::firstOrCreate(['name' => 'assign_project_create']);
        Permission::firstOrCreate(['name' => 'assign_project_read']);
        Permission::firstOrCreate(['name' => 'assign_project_edit']);
        Permission::firstOrCreate(['name' => 'assign_project_delete']);

        Permission::firstOrCreate(['name' => 'branch_create']);
        Permission::firstOrCreate(['name' => 'branch_read']);
        Permission::firstOrCreate(['name' => 'branch_edit']);
        Permission::firstOrCreate(['name' => 'branch_delete']);

        Permission::firstOrCreate(['name' => 'brand_create']);
        Permission::firstOrCreate(['name' => 'brand_read']);
        Permission::firstOrCreate(['name' => 'brand_edit']);
        Permission::firstOrCreate(['name' => 'brand_delete']);

        Permission::firstOrCreate(['name' => 'category_create']);
        Permission::firstOrCreate(['name' => 'category_read']);
        Permission::firstOrCreate(['name' => 'category_edit']);
        Permission::firstOrCreate(['name' => 'category_delete']);

        Permission::firstOrCreate(['name' => 'country_create']);
        Permission::firstOrCreate(['name' => 'country_read']);
        Permission::firstOrCreate(['name' => 'country_edit']);
        Permission::firstOrCreate(['name' => 'country_delete']);

        Permission::firstOrCreate(['name' => 'customer_create']);
        Permission::firstOrCreate(['name' => 'customer_read']);
        Permission::firstOrCreate(['name' => 'customer_edit']);
        Permission::firstOrCreate(['name' => 'customer_delete']);

        Permission::firstOrCreate(['name' => 'employee_create']);
        Permission::firstOrCreate(['name' => 'employee_read']);
        Permission::firstOrCreate(['name' => 'employee_edit']);
        Permission::firstOrCreate(['name' => 'employee_delete']);

        Permission::firstOrCreate(['name' => 'fiscalYear_create']);
        Permission::firstOrCreate(['name' => 'fiscalYear_read']);
        Permission::firstOrCreate(['name' => 'fiscalYear_edit']);
        Permission::firstOrCreate(['name' => 'fiscalYear_delete']);

        Permission::firstOrCreate(['name' => 'holyday_create']);
        Permission::firstOrCreate(['name' => 'holyday_read']);
        Permission::firstOrCreate(['name' => 'holyday_edit']);
        Permission::firstOrCreate(['name' => 'holyday_delete']);

        Permission::firstOrCreate(['name' => 'product_create']);
        Permission::firstOrCreate(['name' => 'product_read']);
        Permission::firstOrCreate(['name' => 'product_edit']);
        Permission::firstOrCreate(['name' => 'product_delete']);

        Permission::firstOrCreate(['name' => 'project_create']);
        Permission::firstOrCreate(['name' => 'project_read']);
        Permission::firstOrCreate(['name' => 'project_edit']);
        Permission::firstOrCreate(['name' => 'project_delete']);

        Permission::firstOrCreate(['name' => 'province_create']);
        Permission::firstOrCreate(['name' => 'province_read']);
        Permission::firstOrCreate(['name' => 'province_edit']);
        Permission::firstOrCreate(['name' => 'province_delete']);

        Permission::firstOrCreate(['name' => 'purchase_create']);
        Permission::firstOrCreate(['name' => 'purchase_read']);
        Permission::firstOrCreate(['name' => 'purchase_edit']);
        Permission::firstOrCreate(['name' => 'purchase_delete']);

        Permission::firstOrCreate(['name' => 'role_create']);
        Permission::firstOrCreate(['name' => 'role_read']);
        Permission::firstOrCreate(['name' => 'role_edit']);
        Permission::firstOrCreate(['name' => 'role_delete']);

        Permission::firstOrCreate(['name' => 'sales_create']);
        Permission::firstOrCreate(['name' => 'sales_read']);
        Permission::firstOrCreate(['name' => 'sales_edit']);
        Permission::firstOrCreate(['name' => 'sales_delete']);

        Permission::firstOrCreate(['name' => 'sales_return_create']);
        Permission::firstOrCreate(['name' => 'sales_return_read']);
        Permission::firstOrCreate(['name' => 'sales_return_edit']);
        Permission::firstOrCreate(['name' => 'sales_return_delete']);

        Permission::firstOrCreate(['name' => 'schedule_create']);
        Permission::firstOrCreate(['name' => 'schedule_read']);
        Permission::firstOrCreate(['name' => 'schedule_edit']);
        Permission::firstOrCreate(['name' => 'schedule_delete']);

        Permission::firstOrCreate(['name' => 'supplier_create']);
        Permission::firstOrCreate(['name' => 'supplier_read']);
        Permission::firstOrCreate(['name' => 'supplier_edit']);
        Permission::firstOrCreate(['name' => 'supplier_delete']);

        Permission::firstOrCreate(['name' => 'tax_create']);
        Permission::firstOrCreate(['name' => 'tax_read']);
        Permission::firstOrCreate(['name' => 'tax_edit']);
        Permission::firstOrCreate(['name' => 'tax_delete']);

        Permission::firstOrCreate(['name' => 'unit_create']);
        Permission::firstOrCreate(['name' => 'unit_read']);
        Permission::firstOrCreate(['name' => 'unit_edit']);
        Permission::firstOrCreate(['name' => 'unit_delete']);


        Permission::firstOrCreate(['name' => 'list_attendance']);

        Permission::firstOrCreate(['name' => 'report_purchase']);
        Permission::firstOrCreate(['name' => 'report_inventory']);
        Permission::firstOrCreate(['name' => 'report_sales']);

        Permission::firstOrCreate(['name' => 'salary_read']);
        Permission::firstOrCreate(['name' => 'salary_payment']);
    }
}
