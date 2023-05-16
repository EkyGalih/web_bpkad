<?php

use App\Http\Controllers\Admin\Galery\BannerVideoController;
use App\Http\Controllers\Admin\Galery\GaleryController;
use App\Http\Controllers\Admin\Galery\GaleryFotoController;
use App\Http\Controllers\Admin\Galery\GaleryVideoController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'galery'], function () {
        Route::get('/', [GaleryController::class, 'index'])->name('galery-admin.index');
        Route::get('create', [GaleryController::class, 'create'])->name('galery-admin.create');
        Route::post('store', [GaleryController::class, 'store'])->name('galery-admin.store');
        Route::get('edit/{id}', [GaleryController::class, 'edit'])->name('galery-admin.edit');
        Route::put('update/{id}', [GaleryController::class, 'update'])->name('galery-admin.update');
        Route::get('destroy/{id}', [GaleryController::class, 'destroy'])->name('galery-admin.destroy');
    });

    Route::group(['prefix' => 'galery-foto'], function () {
        Route::get('/', [GaleryFotoController::class, 'index'])->name('Gfoto-admin.index');
        Route::get('create/{id}', [GaleryFotoController::class, 'create'])->name('Gfoto-admin.create');
        Route::post('store', [GaleryFotoController::class, 'store'])->name('Gfoto-admin.store');
        Route::get('edit/{id}', [GaleryFotoController::class, 'edit'])->name('Gfoto-admin.edit');
        Route::put('update/{id}', [GaleryFotoController::class, 'update'])->name('Gfoto-admin.update');
        Route::get('destroy/{id}', [GaleryFotoController::class, 'destroy'])->name('Gfoto-admin.destroy');
    });

    Route::group(['prefix' => 'galery-video'], function () {
        Route::get('/', [GaleryVideoController::class, 'index'])->name('Gvideo-admin.index');
        Route::get('create/{id}', [GaleryVideoController::class, 'create'])->name('Gvideo-admin.create');
        Route::post('store', [GaleryVideoController::class, 'store'])->name('Gvideo-admin.store');
        Route::get('edit/{id}', [GaleryVideoController::class, 'edit'])->name('Gvideo-admin.edit');
        Route::put('update/{id}', [GaleryVideoController::class, 'update'])->name('Gvideo-admin.update');
        Route::get('destroy/{id}', [GaleryVideoController::class, 'destroy'])->name('Gvideo-admin.destroy');
    });

    Route::group(['prefix' => 'banner-video'], function () {
        Route::get('/', [BannerVideoController::class, 'index'])->name('banner-video.index');
        Route::get('create', [BannerVideoController::class, 'create'])->name('banner-video.create');
        Route::post('store', [BannerVideoController::class, 'store'])->name('banner-video.store');
        Route::post('addVideo}', [BannerVideoController::class, 'addVideo'])->name('banner-video.addVideo');
        Route::get('edit/{id}', [BannerVideoController::class, 'edit'])->name('banner-video.edit');
        Route::get('show/{id}', [BannerVideoController::class, 'show'])->name('banner-video.show');
        Route::put('update/{id}', [BannerVideoController::class, 'update'])->name('banner-video.update');
        Route::get('destroy/{id}', [BannerVideoController::class, 'destroy'])->name('banner-video.destroy');
    });
});
