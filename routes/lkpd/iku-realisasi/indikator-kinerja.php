<?php

use App\Http\Controllers\Admin\IkuRealisasi\IndikatorKinerjaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::group(['prefix' => 'indikator-kinerja'], function() {
        Route::get('/{tahun?}', [IndikatorKinerjaController::class, 'index'])->name('iku-indikator');
        Route::post('store', [IndikatorKinerjaController::class, 'store'])->name('iku-indikator.store');
        Route::put('update/{id}', [IndikatorKinerjaController::class, 'update'])->name('iku-indikator.update');
        Route::get('destroy/{id}', [IndikatorKinerjaController::class, 'destroy'])->name('iku-indikator.destroy');
    });
});
