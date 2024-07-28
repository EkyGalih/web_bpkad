<?php

use App\Http\Controllers\Admin\Inventaris\AsetTIKController;
use App\Http\Controllers\Admin\Inventaris\DashboardController;
use App\Http\Controllers\Admin\Inventaris\KategoriAsetController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/inventaris', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('inventaris.dashboard');

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriAsetController::class, 'index'])->name('inventaris.kategori.index');
        Route::post('store', [KategoriAsetController::class, 'store'])->name('inventaris.kategori.store');
        Route::put('update/{id}', [KategoriAsetController::class, 'update'])->name('inventaris.kategori.update');
        Route::get('destroy/{id}', [KategoriAsetController::class, 'destroy'])->name('inventaris.kategori.destroy');
    });

    Route::group(['prefix' => 'aset-tik'], function () {
        Route::get('/', [AsetTIKController::class, 'index'])->name('inventaris.aset.index');
        Route::get('tambah-aset', [AsetTIKController::class, 'create'])->name('inventaris.aset.create');
        Route::post('store', [AsetTIKController::class, 'store'])->name('inventaris.aset.store');
        Route::get('edit/{id}', [AsetTIKController::class, 'edit'])->name('inventaris.aset.edit');
        Route::put('update/{id}', [AsetTIKController::class, 'update'])->name('inventaris.aset.update');
        Route::get('destroy/{id}', [AsetTIKController::class, 'destroy'])->name('inventaris.aset.destroy');
    });
});
