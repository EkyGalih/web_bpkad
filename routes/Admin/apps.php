<?php

use App\Http\Controllers\Admin\AppsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'apps'], function () {
        Route::get('/', [AppsController::class, 'index'])->name('apps-admin.index');
        Route::get('create', [AppsController::class, 'create'])->name('apps-admin.create');
        Route::post('store', [AppsController::class, 'store'])->name('apps-admin.store');
        Route::get('edit/{id}', [AppsController::class, 'edit'])->name('apps-admin.edit');
        Route::put('update/{id}', [AppsController::class, 'update'])->name('apps-admin.update');
        Route::get('destroy/{id}', [AppsController::class, 'destroy'])->name('apps-admin.destroy');
    });
});
