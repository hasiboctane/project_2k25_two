<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('em-admin')->middleware(['auth', 'verified'])->group(function () {
    // role management

    Route::resource('roles',RoleController::class)->middleware('role:admin|super admin');
    Route::resource('permissions',PermissionController::class)->middleware('role:admin|super admin');
    Route::resource('users',UserController::class)->middleware('role:admin|super admin');

});

