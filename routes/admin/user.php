<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pengguna', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Auth\ManajemenUserController@index')->name('pengguna');
    Route::get('create', 'Auth\ManajemenUserController@create')->name('pengguna.tambah');
    Route::post('store', 'Auth\ManajemenUserController@store')->name('pengguna.store');
    Route::get('edit/{id}', 'Auth\ManajemenUserController@edit')->name('pengguna.ubah');
    Route::put('update/{id}', 'Auth\ManajemenUserController@update')->name('pengguna.update');
    Route::get('show/{id}', 'Auth\ManajemenUserController@show')->name('pengguna.show');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'Users'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');
        Route::get('create', [UsersController::class, 'create'])->name('users.create');
        Route::post('store', [UsersController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::get('show/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::put('update/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::get('destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/{id}', [ProfileController::class, 'index'])->name('profile');
        Route::put('update/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('password/{id}', [ProfileController::class, 'password'])->name('profile.password');
    });
});
