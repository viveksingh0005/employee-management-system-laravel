<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\InventoryBatchController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

   Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
   Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
   Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
   Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
   Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
   Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
   Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
   Route::post('employees/{employee}/documents', [EmployeeController::class, 'storeDocument'])->name('employees.documents.store');
   Route::delete('employees/{employee}/documents/{document}', [EmployeeController::class, 'destroyDocument'])->name('employees.documents.destroy');
 
   

   
   Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
   Route::get('/salaries/create', [SalaryController::class, 'create'])->name('salaries.create');
   Route::post('/salaries', [SalaryController::class, 'store'])->name('salaries.store');
   Route::get('/salaries/{salary}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
   Route::put('/salaries/{salary}', [SalaryController::class, 'update'])->name('salaries.update');
   Route::delete('/salaries/{salary}', [SalaryController::class, 'destroy'])->name('salaries.destroy');
   Route::get('/salaries/employee/{employee}', [SalaryController::class, 'show'])->name('salaries.show');










Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');



    Route::get('/sites', [SiteController::class, 'index'])->name('sites.index');
    Route::get('/sites/create', [SiteController::class, 'create'])->name('sites.create');
    Route::post('/sites', [SiteController::class, 'store'])->name('sites.store');
    Route::get('/sites/{site}/edit', [SiteController::class, 'edit'])->name('sites.edit');
    Route::put('/sites/{site}', [SiteController::class, 'update'])->name('sites.update');
    Route::delete('/sites/{site}', [SiteController::class, 'destroy'])->name('sites.destroy');


    Route::prefix('inventory')->group(function () {
    // Named resource routes
    Route::get('/', [InventoryBatchController::class, 'index'])->name('inventory.index');
    Route::get('/create', [InventoryBatchController::class, 'create'])->name('inventory.create');
    Route::post('/store', [InventoryBatchController::class, 'store'])->name('inventory.store');
    Route::get('/{id}/edit', [InventoryBatchController::class, 'edit'])->name('inventory.edit');
    Route::put('/{id}', [InventoryBatchController::class, 'update'])->name('inventory.update');
    Route::delete('/{id}', [InventoryBatchController::class, 'destroy'])->name('inventory.destroy');
});




Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');








    
});


require __DIR__.'/auth.php';
