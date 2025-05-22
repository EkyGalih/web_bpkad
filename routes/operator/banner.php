<?php

use App\Http\Controllers\Operator\BannerInformasiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'banner-informasi'], function () {
        Route::get('/', [BannerInformasiController::class, 'index'])->name('banner-op.index');
        Route::get('create', [BannerInformasiController::class, 'create'])->name('banner-op.create');
        Route::post('store', [BannerInformasiController::class, 'store'])->name('banner-op.store');
        Route::get('edit/{id}', [BannerInformasiController::class, 'edit'])->name('banner-op.edit');
        Route::put('update/{id}', [BannerInformasiController::class, 'update'])->name('banner-op.update');
        Route::get('destroy/{id}', [BannerInformasiController::class, 'destroy'])->name('banner-op.destroy');
    });
});
