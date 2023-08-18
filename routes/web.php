<?php

use App\Http\Controllers\AssignProjectController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CogsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FiscalYearController;
use App\Http\Controllers\HoleydayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchasePaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesReturnController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('user-profile', [UserController::class, 'profile'])->name('user.profile');

Route::get('organization', [OrganizationController::class, 'index'])->name('organization.index');
Route::get('organization/create', [OrganizationController::class, 'create'])->name('organization.create');
Route::post('organization', [OrganizationController::class, 'store'])->name('organization.store');
Route::get('organization/{organization}/edit', [OrganizationController::class, 'edit'])->name('organization.edit');
Route::put('organization/{organization}/update', [OrganizationController::class, 'update'])->name('organization.update');
Route::delete('organization/{organization}/delete', [OrganizationController::class, 'delete'])->name('organization.delete');
Route::get('organization/{organization}/active', [OrganizationController::class, 'active'])->name('organization.active');

Route::get('branch', [BranchController::class, 'index'])->name('branch.index');
Route::get('branch/create', [BranchController::class, 'create'])->name('branch.create');
Route::post('branch', [BranchController::class, 'store'])->name('branch.store');
Route::get('branch/{id}/edit', [BranchController::class, 'edit'])->name('branch.edit');
Route::put('branch/{branch}/update', [BranchController::class, 'update'])->name('branch.update');

Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
Route::post('brand', [BrandController::class, 'store'])->name('brand.store');
Route::get('brand/{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
Route::put('brand/{brand}/update', [BrandController::class, 'update'])->name('brand.update');
Route::delete('brand/{id}/delete', [BrandController::class, 'delete'])->name('brand.delete');


Route::get('category', [CategoryController::class, 'index'])->name('category.index');
Route::post('category', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('category/{category}/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');


Route::get('unit', [UnitController::class, 'index'])->name('unit.index');
Route::post('unit', [UnitController::class, 'store'])->name('unit.store');
Route::get('unit/{id}/edit', [UnitController::class, 'edit'])->name('unit.edit');
Route::put('unit/{unit}/update', [UnitController::class, 'update'])->name('unit.update');
Route::delete('unit/{id}/delete', [UnitController::class, 'delete'])->name('unit.delete');

Route::get('tax', [TaxController::class, 'index'])->name('tax.index');
Route::post('tax', [TaxController::class, 'store'])->name('tax.store');
Route::get('tax/{id}/edit', [TaxController::class, 'edit'])->name('tax.edit');
Route::put('tax/{tax}/update', [TaxController::class, 'update'])->name('tax.update');
Route::delete('tax/{id}/delete', [TaxController::class, 'delete'])->name('tax.delete');

Route::get('country', [CountryController::class, 'index'])->name('country.index');
Route::post('country', [CountryController::class, 'store'])->name('country.store');
Route::get('country/{id}/edit', [CountryController::class, 'edit'])->name('country.edit');
Route::put('country/{country}/update', [CountryController::class, 'update'])->name('country.update');
Route::delete('country/{id}/delete', [CountryController::class, 'delete'])->name('country.delete');

Route::get('province', [ProvinceController::class, 'index'])->name('province.index');
Route::post('province', [ProvinceController::class, 'store'])->name('province.store');
Route::get('province/{id}/edit', [ProvinceController::class, 'edit'])->name('province.edit');
Route::put('province/{province}/update', [ProvinceController::class, 'update'])->name('province.update');
Route::delete('province/{id}/delete', [ProvinceController::class, 'delete'])->name('province.delete');
Route::get('province/{id}/select', [ProvinceController::class, 'select'])->name('province.select');

Route::get('product', [ProductController::class, 'index'])->name('product.index');
Route::post('product', [ProductController::class, 'store'])->name('product.store');
Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/{product}/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');

Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::post('supplier', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('supplier/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::put('supplier/{supplier}/update', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('supplier/{id}/delete', [SupplierController::class, 'delete'])->name('supplier.delete');

Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
Route::post('customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('customer/{customer}/update', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('customer/{id}/delete', [CustomerController::class, 'delete'])->name('customer.delete');
Route::get('filter-customer/{number}', [CustomerController::class, 'filterCustomer'])->name('filterCustomer');

Route::get('fiscal-year', [FiscalYearController::class, 'index'])->name('fiscalyear.index');
Route::post('fiscal-year', [FiscalYearController::class, 'store'])->name('fiscalyear.store');
Route::get('fiscal-year/{id}/edit', [FiscalYearController::class, 'edit'])->name('fiscalyear.edit');
Route::put('fiscal-year/{fiscal-year}/update', [FiscalYearController::class, 'update'])->name('fiscalyear.update');
Route::delete('fiscal-year/{id}/delete', [FiscalYearController::class, 'delete'])->name('fiscalyear.delete');
Route::get('fiscal-year/{id}/active', [FiscalYearController::class, 'active'])->name('fiscalyear.active');

Route::post('cogs', [CogsController::class, 'store'])->name('cogs.store');
Route::get('cogs/{id}/edit', [CogsController::class, 'edit'])->name('cogs.edit');
Route::put('cogs/{cogs}/update', [CogsController::class, 'update'])->name('cogs.update');
Route::delete('cogs/{id}/delete', [CogsController::class, 'delete'])->name('cogs.delete');
Route::get('cogs/{id}/active', [CogsController::class, 'active'])->name('cogs.active');

Route::get('opening-balance', [PurchaseController::class, 'openingBalance'])->name('openingBalance');
Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase.index');
Route::get('purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
Route::post('purchase', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('purchase/{id}/edit', [PurchaseController::class, 'edit'])->name('purchase.edit');
Route::put('purchase/{purchase}/update', [PurchaseController::class, 'update'])->name('purchase.update');
Route::delete('purchase/{id}/delete', [PurchaseController::class, 'delete'])->name('purchase.delete');
Route::get('purchase/{id}/active', [PurchaseController::class, 'active'])->name('purchase.active');
Route::get('purchase-payment/{id}', [PurchasePaymentController::class, 'payment'])->name('payment');
Route::get('purchase/{id}/payment', [PurchasePaymentController::class, 'repayment'])->name('repayment');
Route::post('purchase/pay', [PurchasePaymentController::class, 'pay'])->name('pay');
Route::get('purchase/{id}/supplier', [PurchasePaymentController::class, 'supplier'])->name('purchase.supplier');

Route::get('sales', [SalesController::class, 'create'])->name('sales.create');
Route::post('sales', [SalesController::class, 'store'])->name('sales.store');
Route::get('sales-payment/{id}', [SalesController::class, 'payment'])->name('sales.payment');
Route::post('sales/pay', [SalesController::class, 'paySales'])->name('paySales');
Route::get('sales/list', [SalesController::class, 'index'])->name('sales.index');
Route::get('sales/{id}/payment', [SalesController::class, 'repayment'])->name('sales.repayment');
Route::delete('sales/{id}/delete', [SalesController::class, 'delete'])->name('sales.delete');

Route::get('sales-return', [SalesReturnController::class, 'index'])->name('salesreturn.index');
// Route::get('sales-return/create',[SalesReturnController::class,'create'])->name('salesreturn.create');
Route::post('sales-return', [SalesReturnController::class, 'store'])->name('salesreturn.store');
Route::get('salesReturn/{invoice}', [SalesReturnController::class, 'salesReturn'])->name('salesReturn');

Route::get('totalpurchase/{month}', [HomeController::class, 'totalPurchase'])->name('totalPurchase');
Route::get('totalsales/{month}', [HomeController::class, 'totalSales'])->name('totalSales');

Route::get('purchase-report', [ReportController::class, 'purchaseReport'])->name('purchaseReport');
Route::get('sales-report', [ReportController::class, 'salesReport'])->name('salesReport');
Route::get('inventory-report', [ReportController::class, 'inventoryReport'])->name('inventoryReport');

Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('role', [RoleController::class, 'store'])->name('role.store');
Route::get('role', [RoleController::class, 'index'])->name('role.index');
Route::get('role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::put('role/{role}/update', [RoleController::class, 'update'])->name('role.update');
Route::delete('role/{role}/delete', [RoleController::class, 'delete'])->name('role.delete');

Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('employee/{employee}/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('employee/{employee}/delete', [EmployeeController::class, 'delete'])->name('employee.delete');


Route::post('project', [ProjectController::class, 'store'])->name('project.store');
Route::get('project', [ProjectController::class, 'index'])->name('project.index');
Route::get('project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
Route::put('project/{project}/update', [ProjectController::class, 'update'])->name('project.update');
Route::delete('project/{project}/delete', [ProjectController::class, 'delete'])->name('project.delete');

Route::post('assign-project', [AssignProjectController::class, 'store'])->name('assign-project.store');
Route::get('assign-project', [AssignProjectController::class, 'index'])->name('assign-project.index');
Route::get('assign-project/{id}/edit', [AssignProjectController::class, 'edit'])->name('assign-project.edit');
Route::put('assign-project/{id}/update', [AssignProjectController::class, 'update'])->name('assign-project.update');
Route::delete('assign-project/{id}/delete', [AssignProjectController::class, 'delete'])->name('assign-project.delete');

Route::get('time-schedule',[ScheduleController::class,'index'])->name('schedule.index');
Route::get('time-schedule/{id}',[ScheduleController::class,'getEmployee'])->name('getEmployee');
Route::post('time-schedule',[ScheduleController::class,'store'])->name('schedule.store');
Route::get('time-schedule/{id}/edit',[ScheduleController::class,'edit'])->name('schedule.edit');
Route::put('time-schedule/{id}/update',[ScheduleController::class,'update'])->name('schedule.update');
Route::delete('time-schedule/{id}/delete',[ScheduleController::class,'delete'])->name('schedule.delete');


Route::get('leave-type',[LeaveTypeController::class,'index'])->name('leaveType.index');
Route::post('leave-type',[LeaveTypeController::class,'store'])->name('leaveType.store');
Route::get('leave-type/{id}/edit',[LeaveTypeController::class,'edit'])->name('leaveType.edit');
Route::put('leave-type/{id}/update',[LeaveTypeController::class,'update'])->name('leaveType.update');
Route::delete('leave-type/{id}/delete',[LeaveTypeController::class,'delete'])->name('leaveType.delete');


Route::get('leave',[LeaveController::class,'index'])->name('leave.index');
Route::post('leave',[LeaveController::class,'store'])->name('leave.store');
Route::get('leave/{leave}/edit',[LeaveController::class,'edit'])->name('leave.edit');
Route::put('leave/{leave}/update',[LeaveController::class,'update'])->name('leave.update');
Route::delete('leave/{leave}/delete',[LeaveController::class,'delete'])->name('leave.delete');
Route::get('leave-list',[LeaveController::class,'list'])->name('leave.list');
Route::post('leave-status/{id}/accept',[LeaveController::class,'statusAccept'])->name('leave.status.accept');
Route::post('leave-status/{id}/reject',[LeaveController::class,'statusReject'])->name('leave.status.reject');

Route::get('attendance',[AttendanceController::class,'index'])->name('attendance.index');
// Route::post('take-attendance',[AttendanceController::class,'in'])->name('attendance.in');
Route::post('take-attendance',[AttendanceController::class,'store'])->name('attendance.store');
Route::get('take-attendance/{id}',[AttendanceController::class,'update'])->name('attendance.update');
Route::get('take-attendance',[AttendanceController::class,'saturday'])->name('attendance.saturday');
// Route::get('sales-return/{id}/edit',[SalesReturnController::class,'edit'])->name('salesreturn.edit');
// Route::put('sales-return/{sales-return}/update',[SalesReturnController::class,'update'])->name('salesreturn.update');


Route::post('holey-day', [HoleydayController::class, 'store'])->name('holey-day.store');
Route::get('holey-day', [HoleydayController::class, 'index'])->name('holey-day.index');
Route::get('holey-day/{holeyday}/edit', [HoleydayController::class, 'edit'])->name('holey-day.edit');
Route::put('holey-day/{holeyday}/update', [HoleydayController::class, 'update'])->name('holey-day.update');
Route::delete('holey-day/{holeyday}/delete', [HoleydayController::class, 'delete'])->name('holey-day.delete');

Route::get('salary', [SalaryController::class, 'index'])->name('salary.index');
Route::get('salary/{id}/payment', [SalaryController::class, 'payment'])->name('salary.payment');
Route::post('salary/payment', [SalaryController::class, 'pay'])->name('salary.pay');


Route::get('/foo', function () {
    Artisan::call('storage:link');
});



Route::get('/migrate',function(){
    $exitCode=Artisan::call('migrate');
});

Route::get('/migrate-refresh',function(){
    $exitCode=Artisan::call('migrate:refresh');
});

Route::get('/seed',function(){
    $exitCode=Artisan::call('db:seed');
    return $exitCode;
});
