<?php

use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', [MenuController::class, 'index'])->name('menu-admin.index');
            Route::post('store', [MenuController::class, 'store'])->name('menu-admin.store');
            Route::put('update/{id}', [MenuController::class, 'update'])->name('menu-admin.update');
            Route::get('destroy/{id}', [MenuController::class, 'destroy'])->name('menu-admin.destroy');
        });
    });
});
