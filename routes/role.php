<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('em-admin')->middleware(['auth', 'verified'])->group(function () {
    // role management
    Route::view('/role-management', 'admin.role&permission.index')->name('role.management');
    Route::resource('permissions',PermissionController::class);

});

