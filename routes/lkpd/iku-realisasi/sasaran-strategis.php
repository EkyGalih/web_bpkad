<?php

use App\Http\Controllers\Admin\IkuRealisasi\SasaranStrategisController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::group(['prefix' => 'sasaran-strategis'], function() {
        Route::get('/{tahun?}', [SasaranStrategisController::class, 'index'])->name('iku-sasaran');
        Route::post('store', [SasaranStrategisController::class, 'store'])->name('iku-sasaran.store');
        Route::put('update/{id}', [SasaranStrategisController::class, 'update'])->name('iku-sasaran.update');
        Route::get('destroy/{id}', [SasaranStrategisController::class, 'destroy'])->name('iku-sasaran.destroy');
    });
});
