<?php

use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web/tools'], function () {
        Route::group(['prefix' => 'menu'], function () {
            Route::get('/', [MenuController::class, 'index'])->name('menu-admin.index');
            Route::post('store', [MenuController::class, 'store'])->name('menu-admin.store');
            Route::put('update/{id}', [MenuController::class, 'update'])->name('menu-admin.update');
            Route::post('sort', [MenuController::class, 'sort'])->name('menu-admin.sort');
            Route::delete('destroy/{id}', [MenuController::class, 'destroy'])->name('menu-admin.destroy');
        });
    });
});
