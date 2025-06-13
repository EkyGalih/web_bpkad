<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Tools\AddressController;
use App\Http\Controllers\Admin\Tools\AppsController;
use App\Http\Controllers\Admin\Tools\LinkController;
use App\Http\Controllers\Admin\Tools\SocialController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'tools/address'], function () {
            Route::get('/', [AddressController::class, 'index'])->name('address.index');
            Route::put('update/{address}', [AddressController::class, 'update'])->name('address.update');
        });

        Route::group(['prefix' => 'tools/link'], function () {
            Route::get('/', [LinkController::class, 'index'])->name('link.index');
            Route::post('store', [LinkController::class, 'store'])->name('link.store');
            Route::put('update/{link}', [LinkController::class, 'update'])->name('link.update');
            Route::get('destroy/{link}', [LinkController::class, 'destroy'])->name('link.destroy');
        });

        Route::group(['prefix' => 'tools/social'], function () {
            Route::get('/', [SocialController::class, 'index'])->name('social.index');
            Route::post('store', [SocialController::class, 'store'])->name('social.store');
            Route::put('update/{id}', [SocialController::class, 'update'])->name('social.update');
            Route::get('destroy/{id}', [SocialController::class, 'destroy'])->name('social.destroy');
        });

        Route::group(['prefix' => 'tools/apps'], function () {
            Route::get('/', [AppsController::class, 'index'])->name('apps.index');
            Route::get('create', [AppsController::class, 'create'])->name('apps.create');
            Route::post('store', [AppsController::class, 'store'])->name('apps.store');
            Route::get('edit/{apps}', [AppsController::class, 'edit'])->name('apps.edit');
            Route::put('update/{apps}', [AppsController::class, 'update'])->name('apps.update');
            Route::get('destroy/{apps}', [AppsController::class, 'destroy'])->name('apps.destroy');
        });

        Route::group(['prefix' => 'tools/olympic'], function () {
            Route::get('/', [AdminController::class, 'olympic'])->name('olympic-admin.index');
            Route::post('create-periode', [AdminController::class, 'create_periode'])->name('olympic-admin.create-periode');
            Route::post('store', [AdminController::class, 'store'])->name('olympic-admin.store');
            Route::put('update/{id}', [AdminController::class, 'update'])->name('olympic-admin.update');
            Route::get('destroy/{id}', [AdminController::class, 'destroy'])->name('olympic-admin.destroy');
        });
    });
});
