<?php

use App\Http\Controllers\Admin\Galery\BannerVideoController;
use App\Http\Controllers\Admin\Galery\GaleryController;
use App\Http\Controllers\Admin\Galery\GaleryFotoController;
use App\Http\Controllers\Admin\Galery\GaleryVideoController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'data-informasi'], function () {
            Route::group(['prefix' => 'galery'], function () {
                Route::resource('galery', GaleryController::class)->except(['destroy']);
                Route::get('destroy/{galery}', [GaleryController::class, 'destroy'])->name('galery.destroy');
                Route::group(['prefix' => 'foto'], function () {
                    Route::get('/', [GaleryFotoController::class, 'index'])->name('galery-foto.index');
                    Route::get('create/{galery}', [GaleryFotoController::class, 'create'])->name('galery-foto.create');
                    Route::post('store', [GaleryFotoController::class, 'store'])->name('galery-foto.store');
                    Route::get('edit/{foto}', [GaleryFotoController::class, 'edit'])->name('galery-foto.edit');
                    Route::get('list-foto/{foto}', [GaleryFotoController::class, 'show'])->name('galery-foto.show');
                    Route::put('update/{foto}', [GaleryFotoController::class, 'update'])->name('galery-foto.update');
                    Route::get('destroy/{foto}', [GaleryFotoController::class, 'destroy'])->name('galery-foto.destroy');
                });

                Route::group(['prefix' => 'video'], function () {
                    Route::get('/', [GaleryVideoController::class, 'index'])->name('galery-video.index');
                    Route::get('create/{galery}', [GaleryVideoController::class, 'create'])->name('galery-video.create');
                    Route::post('store', [GaleryVideoController::class, 'store'])->name('galery-video.store');
                    Route::get('list-video/{video}', [GaleryVideoController::class, 'show'])->name('galery-video.show');
                    Route::get('edit/{video}', [GaleryVideoController::class, 'edit'])->name('galery-video.edit');
                    Route::put('update/{video}', [GaleryVideoController::class, 'update'])->name('galery-video.update');
                    Route::get('destroy/{video}', [GaleryVideoController::class, 'destroy'])->name('galery-video.destroy');
                });

                Route::group(['prefix' => 'video-banner'], function () {
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
        });
    });
});
