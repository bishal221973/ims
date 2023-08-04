<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CogsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FiscalYearController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchasePaymentController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('session');

Route::get('user-profile',[UserController::class,'profile'])->name('user.profile');

Route::get('organization',[OrganizationController::class,'index'])->name('organization.index');
Route::get('organization/create',[OrganizationController::class,'create'])->name('organization.create');
Route::post('organization',[OrganizationController::class,'store'])->name('organization.store');
Route::get('organization/{organization}/edit',[OrganizationController::class,'edit'])->name('organization.edit');
Route::put('organization/{organization}/update',[OrganizationController::class,'update'])->name('organization.update');
Route::delete('organization/{organization}/delete',[OrganizationController::class,'delete'])->name('organization.delete');
Route::get('organization/{organization}/active',[OrganizationController::class,'active'])->name('organization.active')->middleware('session');

Route::get('branch',[BranchController::class,'index'])->name('branch.index');
Route::get('branch/create',[BranchController::class,'create'])->name('branch.create');
Route::post('branch',[BranchController::class,'store'])->name('branch.store');
Route::get('branch/{id}/edit',[BranchController::class,'edit'])->name('branch.edit');
Route::put('branch/{branch}/update',[BranchController::class,'update'])->name('branch.update');

Route::get('brand',[BrandController::class,'index'])->name('brand.index');
Route::post('brand',[BrandController::class,'store'])->name('brand.store');
Route::get('brand/{id}/edit',[BrandController::class,'edit'])->name('brand.edit');
Route::put('brand/{brand}/update',[BrandController::class,'update'])->name('brand.update');
Route::delete('brand/{id}/delete',[BrandController::class,'delete'])->name('brand.delete');


Route::get('category',[CategoryController::class,'index'])->name('category.index');
Route::post('category',[CategoryController::class,'store'])->name('category.store');
Route::get('category/{id}/edit',[CategoryController::class,'edit'])->name('category.edit');
Route::put('category/{category}/update',[CategoryController::class,'update'])->name('category.update');
Route::delete('category/{id}/delete',[CategoryController::class,'delete'])->name('category.delete');


Route::get('unit',[UnitController::class,'index'])->name('unit.index');
Route::post('unit',[UnitController::class,'store'])->name('unit.store');
Route::get('unit/{id}/edit',[UnitController::class,'edit'])->name('unit.edit');
Route::put('unit/{unit}/update',[UnitController::class,'update'])->name('unit.update');
Route::delete('unit/{id}/delete',[UnitController::class,'delete'])->name('unit.delete');

Route::get('tax',[TaxController::class,'index'])->name('tax.index');
Route::post('tax',[TaxController::class,'store'])->name('tax.store');
Route::get('tax/{id}/edit',[TaxController::class,'edit'])->name('tax.edit');
Route::put('tax/{tax}/update',[TaxController::class,'update'])->name('tax.update');
Route::delete('tax/{id}/delete',[TaxController::class,'delete'])->name('tax.delete');

Route::get('country',[CountryController::class,'index'])->name('country.index');
Route::post('country',[CountryController::class,'store'])->name('country.store');
Route::get('country/{id}/edit',[CountryController::class,'edit'])->name('country.edit');
Route::put('country/{country}/update',[CountryController::class,'update'])->name('country.update');
Route::delete('country/{id}/delete',[CountryController::class,'delete'])->name('country.delete');

Route::get('province',[ProvinceController::class,'index'])->name('province.index');
Route::post('province',[ProvinceController::class,'store'])->name('province.store');
Route::get('province/{id}/edit',[ProvinceController::class,'edit'])->name('province.edit');
Route::put('province/{province}/update',[ProvinceController::class,'update'])->name('province.update');
Route::delete('province/{id}/delete',[ProvinceController::class,'delete'])->name('province.delete');

Route::get('product',[ProductController::class,'index'])->name('product.index');
Route::post('product',[ProductController::class,'store'])->name('product.store');
Route::get('product/{id}/edit',[ProductController::class,'edit'])->name('product.edit');
Route::put('product/{product}/update',[ProductController::class,'update'])->name('product.update');
Route::delete('product/{id}/delete',[ProductController::class,'delete'])->name('product.delete');

Route::get('supplier',[SupplierController::class,'index'])->name('supplier.index');
Route::post('supplier',[SupplierController::class,'store'])->name('supplier.store');
Route::get('supplier/{id}/edit',[SupplierController::class,'edit'])->name('supplier.edit');
Route::put('supplier/{supplier}/update',[SupplierController::class,'update'])->name('supplier.update');
Route::delete('supplier/{id}/delete',[SupplierController::class,'delete'])->name('supplier.delete');

Route::get('customer',[CustomerController::class,'index'])->name('customer.index');
Route::post('customer',[CustomerController::class,'store'])->name('customer.store');
Route::get('customer/{id}/edit',[CustomerController::class,'edit'])->name('customer.edit');
Route::put('customer/{customer}/update',[CustomerController::class,'update'])->name('customer.update');
Route::delete('customer/{id}/delete',[CustomerController::class,'delete'])->name('customer.delete');

Route::get('fiscal-year',[FiscalYearController::class,'index'])->name('fiscalyear.index');
Route::post('fiscal-year',[FiscalYearController::class,'store'])->name('fiscalyear.store');
Route::get('fiscal-year/{id}/edit',[FiscalYearController::class,'edit'])->name('fiscalyear.edit');
Route::put('fiscal-year/{fiscal-year}/update',[FiscalYearController::class,'update'])->name('fiscalyear.update');
Route::delete('fiscal-year/{id}/delete',[FiscalYearController::class,'delete'])->name('fiscalyear.delete');
Route::get('fiscal-year/{id}/active',[FiscalYearController::class,'active'])->name('fiscalyear.active');

Route::post('cogs',[CogsController::class,'store'])->name('cogs.store');
Route::get('cogs/{id}/edit',[CogsController::class,'edit'])->name('cogs.edit');
Route::put('cogs/{cogs}/update',[CogsController::class,'update'])->name('cogs.update');
Route::delete('cogs/{id}/delete',[CogsController::class,'delete'])->name('cogs.delete');
Route::get('cogs/{id}/active',[CogsController::class,'active'])->name('cogs.active');

Route::get('opening-balance',[PurchaseController::class,'openingBalance'])->name('openingBalance');
Route::get('purchase',[PurchaseController::class,'index'])->name('purchase.index');
Route::get('purchase/create',[PurchaseController::class,'create'])->name('purchase.create');
Route::post('purchase',[PurchaseController::class,'store'])->name('purchase.store');
Route::get('purchase/{id}/edit',[PurchaseController::class,'edit'])->name('purchase.edit');
Route::put('purchase/{purchase}/update',[PurchaseController::class,'update'])->name('purchase.update');
Route::delete('purchase/{id}/delete',[PurchaseController::class,'delete'])->name('purchase.delete');
Route::get('purchase/{id}/active',[PurchaseController::class,'active'])->name('purchase.active');
Route::get('purchase-payment/{id}',[PurchasePaymentController::class,'payment'])->name('payment');
Route::get('purchase/{id}/payment',[PurchasePaymentController::class,'repayment'])->name('repayment');
Route::post('purchase/pay',[PurchasePaymentController::class,'pay'])->name('pay');
