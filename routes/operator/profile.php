<?php

use App\Http\Controllers\Operator\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/{id}', [ProfileController::class, 'index'])->name('profile');
        Route::put('update/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('password/{id}', [ProfileController::class, 'password'])->name('profile.password');
    });
});
