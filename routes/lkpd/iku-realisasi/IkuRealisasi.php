<?php

use App\Http\Controllers\Admin\IkuRealisasi\IkuRealisasiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'Iku_dan_Realisasi'], function () {
        Route::get('/', [IkuRealisasiController::class, 'index'])->name('iku-realisasi.index');
        Route::post('store', [IkuRealisasiController::class, 'store'])->name('iku-realisasi.store');
        Route::put('update/{id}', [IkuRealisasiController::class, 'update'])->name('iku-realisasi.update');
        Route::get('destroy/{id}', [IkuRealisasiController::class, 'destroy'])->name('iku-realisasi.destroy');
    });
});
