<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
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
    
});

require __DIR__.'/auth.php';
