<?php

use App\Http\Controllers\Admin\Inventaris\AsetTIKController;
use App\Http\Controllers\Admin\Inventaris\DashboardController;
use App\Http\Controllers\Admin\Inventaris\KategoriAsetController;
use App\Http\Controllers\Admin\Inventaris\LokasiAsetController;
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
        Route::get('/detail-aset/{id}', [AsetTIKController::class, 'detail'])->name('inventaris.aset.detail');
        Route::put('update/{id}', [AsetTIKController::class, 'update'])->name('inventaris.aset.update');
        Route::delete('destroy/{id}', [AsetTIKController::class, 'destroy'])->name('inventaris.aset.destroy');
    });

    Route::group(['prefix' => 'lokasi-aset'], function () {
        Route::get('/', [LokasiAsetController::class, 'index'])->name('inventaris.lokasi.index');
        Route::get('/tambah-lokasi', [LokasiAsetController::class, 'create'])->name('inventaris.lokasi.create');
        Route::post('store', [LokasiAsetController::class, 'store'])->name('inventaris.lokasi.store');
        Route::get('/ubah-lokasi/{id}', [LokasiAsetController::class, 'edit'])->name('inventaris.lokasi.edit');
        Route::put('update/{id}', [LokasiAsetController::class, 'update'])->name('inventaris.lokasi.update');
        Route::delete('destroy/{id}', [LokasiAsetController::class, 'destroy'])->name('inventaris.lokasi.destroy');
    });
});
