<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('em-admin')->middleware(['auth', 'verified'])->group(function () {
    // role management
    // Route::view('/role-management', 'admin.role&permission.index')->name('role.management');
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);
    Route::resource('users',UserController::class);

});

