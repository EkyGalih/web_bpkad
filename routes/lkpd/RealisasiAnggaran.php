<?php

use App\Http\Controllers\LKPD\Admin\RealisasiAnggaranController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'lkpd'], function () {
        Route::group(['prefix' => 'Realisasi-Anggaran'], function () {
            Route::get('/{tahun?}', [RealisasiAnggaranController::class, 'index'])->name('lkpd.realisasi-anggaran');
            Route::put('update', [RealisasiAnggaranController::class, 'update'])->name('lkpd.realisasi-anggaran.update');
        });
    });
});
