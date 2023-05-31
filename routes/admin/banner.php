<?php

use App\Http\Controllers\Admin\BannerInformasiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'banner-informasi'], function () {
        Route::get('/', [BannerInformasiController::class, 'index'])->name('banner.index');
        Route::get('create', [BannerInformasiController::class, 'create'])->name('banner.create');
        Route::post('store', [BannerInformasiController::class, 'store'])->name('banner.store');
        Route::get('edit/{id}', [BannerInformasiController::class, 'edit'])->name('banner.edit');
        Route::put('update/{id}', [BannerInformasiController::class, 'update'])->name('banner.update');
        Route::get('destroy/{id}', [BannerInformasiController::class, 'destroy'])->name('banner.destroy');
    });
});
