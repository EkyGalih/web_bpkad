<?php

use App\Http\Controllers\Operator\Galery\BannerVideoController;
use App\Http\Controllers\Operator\Galery\GaleryController;
use App\Http\Controllers\Operator\Galery\GaleryFotoController;
use App\Http\Controllers\Operator\Galery\GaleryVideoController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'galery'], function () {
        Route::get('/', [GaleryController::class, 'index'])->name('galery-op.index');
        Route::get('create', [GaleryController::class, 'create'])->name('galery-op.create');
        Route::post('store', [GaleryController::class, 'store'])->name('galery-op.store');
        Route::get('edit/{id}', [GaleryController::class, 'edit'])->name('galery-op.edit');
        Route::put('update/{id}', [GaleryController::class, 'update'])->name('galery-op.update');
        Route::get('destroy/{id}', [GaleryController::class, 'destroy'])->name('galery-op.destroy');
    });

    Route::group(['prefix' => 'galery-foto'], function () {
        Route::get('/', [GaleryFotoController::class, 'index'])->name('Gfoto-op.index');
        Route::get('create/{id}', [GaleryFotoController::class, 'create'])->name('Gfoto-op.create');
        Route::post('store', [GaleryFotoController::class, 'store'])->name('Gfoto-op.store');
        Route::get('edit/{id}', [GaleryFotoController::class, 'edit'])->name('Gfoto-op.edit');
        Route::put('update/{id}', [GaleryFotoController::class, 'update'])->name('Gfoto-op.update');
        Route::get('destroy/{id}', [GaleryFotoController::class, 'destroy'])->name('Gfoto-op.destroy');
    });

    Route::group(['prefix' => 'galery-video'], function () {
        Route::get('/', [GaleryVideoController::class, 'index'])->name('Gvideo-op.index');
        Route::get('create/{id}', [GaleryVideoController::class, 'create'])->name('Gvideo-op.create');
        Route::post('store', [GaleryVideoController::class, 'store'])->name('Gvideo-op.store');
        Route::get('edit/{id}', [GaleryVideoController::class, 'edit'])->name('Gvideo-op.edit');
        Route::put('update/{id}', [GaleryVideoController::class, 'update'])->name('Gvideo-op.update');
        Route::get('destroy/{id}', [GaleryVideoController::class, 'destroy'])->name('Gvideo-op.destroy');
    });

    Route::group(['prefix' => 'banner-video'], function () {
        Route::get('/', [BannerVideoController::class, 'index'])->name('banner-op-video.index');
        Route::get('create', [BannerVideoController::class, 'create'])->name('banner-op-video.create');
        Route::post('store', [BannerVideoController::class, 'store'])->name('banner-op-video.store');
        Route::post('addVideo}', [BannerVideoController::class, 'addVideo'])->name('banner-op-video.addVideo');
        Route::get('edit/{id}', [BannerVideoController::class, 'edit'])->name('banner-op-video.edit');
        Route::get('show/{id}', [BannerVideoController::class, 'show'])->name('banner-op-video.show');
        Route::put('update/{id}', [BannerVideoController::class, 'update'])->name('banner-op-video.update');
        Route::get('destroy/{id}', [BannerVideoController::class, 'destroy'])->name('banner-op-video.destroy');
    });
});
