<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
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
   Route::get('/salaries/{salary}', [SalaryController::class, 'show'])->name('salaries.show');
   Route::get('/salaries/{salary}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');
   Route::put('/salaries/{salary}', [SalaryController::class, 'update'])->name('salaries.update');
   Route::delete('/salaries/{salary}', [SalaryController::class, 'destroy'])->name('salaries.destroy');
   Route::get('my-salaries', [SalaryController::class, 'mySalaries'])->name('salaries.my');


Route::prefix('attendances')->group(function () {
 
    Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('/', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
    Route::put('/{attendance}', [AttendanceController::class, 'update'])->name('attendances.update');
    Route::delete('/{attendance}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
    Route::get('/month/{year}/{month}', [AttendanceController::class, 'monthView'])->name('attendances.month');


});

    
});

require __DIR__.'/auth.php';
