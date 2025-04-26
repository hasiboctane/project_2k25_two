<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('em-admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories',CategoryController::class)->except(['show','edit']);
    // create category with ajax
    Route::post('categories/ajax-store',[CategoryController::class,'ajaxStore'])->name('categories.ajax-store');
    Route::resource('events',EventController::class);
});


Route::prefix('em-admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
