<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::group(['prefix' => 'pengguna'], function() {
        Route::get('/', [UsersController::class, 'index'])->name('admin-pengguna');
        Route::post('store', [UsersController::class, 'store'])->name('admin-pengguna.store');
        Route::get('profile/{id}', [UsersController::class, 'profile'])->name('admin-pengguna.profile');
        Route::put('udpate/{id}', [UsersController::class, 'update'])->name('admin-pengguna.update');
        Route::get('destroy/{id}', [UsersController::class, 'destroy'])->name('admin-pengguna.destroy');
        Route::put('password/{id}', [UsersController::class, 'password'])->name('admin-pengguna.password');
        Route::put('foto/{id}', [UsersController::class, 'foto'])->name('admin-pengguna.foto');
    });
});
