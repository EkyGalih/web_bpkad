<?php

use App\Http\Controllers\Admin\LaporanMasyarakatController;
use App\Http\Controllers\Admin\PermohonanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', [LaporanMasyarakatController::class, 'index'])->name('laporan-admin.index');
        Route::get('create', [LaporanMasyarakatController::class, 'create'])->name('laporan-admin.create');
        Route::post('store', [LaporanMasyarakatController::class, 'store'])->name('laporan-admin.store');
        Route::get('edit/{id}', [LaporanMasyarakatController::class, 'edit'])->name('laporan-admin.edit');
        Route::put('upadte/{id}', [LaporanMasyarakatController::class, 'update'])->name('laporan-admin.update');
        Route::get('destroy/{id}', [LaporanMasyarakatController::class, 'destroy'])->name('laporan-admin.destroy');
    });

    Route::group(['prefix' => 'permohonan'], function () {
        Route::get('/', [PermohonanController::class, 'index'])->name('permohonan-admin.index');
        Route::get('create', [PermohonanController::class, 'create'])->name('permohonan-admin.create');
        Route::post('store', [PermohonanController::class, 'store'])->name('permohonan-admin.store');
        Route::get('edit/{id}', [PermohonanController::class, 'edit'])->name('permohonan-admin.edit');
        Route::put('upadte/{id}', [PermohonanController::class, 'update'])->name('permohonan-admin.update');
        Route::get('destroy/{id}', [PermohonanController::class, 'destroy'])->name('permohonan-admin.destroy');
        Route::get('status/{id}', [PermohonanController::class, 'status'])->name('permohonan-admin.status');
    });
});
