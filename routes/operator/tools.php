<?php

use App\Http\Controllers\Operator\Tools\AddressController;
use App\Http\Controllers\Operator\Tools\AppsController;
use App\Http\Controllers\Operator\Tools\LinkController;
use App\Http\Controllers\Operator\Tools\SocialController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'tools-address'], function () {
        Route::get('/', [AddressController::class, 'index'])->name('tools-op-address');
        Route::post('store', [AddressController::class, 'store'])->name('tools-op-address.store');
        Route::put('update/{id}', [AddressController::class, 'update'])->name('tools-op-address.update');
    });

    Route::group(['prefix' => 'tools-link'], function () {
        Route::get('/{id?}', [LinkController::class, 'index'])->name('tools-op-link');
        Route::post('store', [LinkController::class, 'store'])->name('tools-op-link.store');
        Route::put('update/{id}', [LinkController::class, 'update'])->name('tools-op-link.update');
        Route::get('destroy/{id}', [LinkController::class, 'destroy'])->name('tools-op-link.destroy');
    });

    Route::group(['prefix' => 'tools-social'], function () {
        Route::get('/', [SocialController::class, 'index'])->name('tools-op-social');
        Route::post('store', [SocialController::class, 'store'])->name('tools-op-social.store');
        Route::put('update/{id}', [SocialController::class, 'update'])->name('tools-op-social.update');
        Route::get('destroy/{id}', [SocialController::class, 'destroy'])->name('tools-op-social.destroy');
    });

    Route::group(['prefix' => 'apps'], function () {
        Route::get('/', [AppsController::class, 'index'])->name('apps-op.index');
        Route::get('create', [AppsController::class, 'create'])->name('apps-op.create');
        Route::post('store', [AppsController::class, 'store'])->name('apps-op.store');
        Route::get('edit/{id}', [AppsController::class, 'edit'])->name('apps-op.edit');
        Route::put('update/{id}', [AppsController::class, 'update'])->name('apps-op.update');
        Route::get('destroy/{id}', [AppsController::class, 'destroy'])->name('apps-op.destroy');
    });

});
