<?php

use App\Http\Controllers\Admin\Inventaris\DashboardController;
use App\Http\Controllers\Admin\Inventaris\KategoriAsetController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/inventaris', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('inventaris.dashboard');

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriAsetController::class, 'index'])->name('inventaris.kategori.index');
        Route::get('create', [KategoriAsetController::class, 'create'])->name('inventaris.kategori.create');
        Route::post('store', [KategoriAsetController::class, 'store'])->name('inventaris.kategori.store');
        Route::get('edit/{id}', [KategoriAsetController::class, 'edit'])->name('inventaris.kategori.edit');
        Route::put('update/{id}', [KategoriAsetController::class, 'update'])->name('inventaris.kategori.update');
        Route::get('destroy/{id}', [KategoriAsetController::class, 'destroy'])->name('inventaris.kategori.destroy');
    });
});
