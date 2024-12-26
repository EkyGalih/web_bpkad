<?php

use App\Http\Controllers\Admin\IkuRealisasi\FormulaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::group(['prefix' => 'formulasi-iku-realisasi'], function() {
        Route::get('/{tahun?}', [FormulaController::class, 'index'])->name('iku-formulasi');
        Route::post('store', [FormulaController::class, 'store'])->name('iku-formulasi.store');
        Route::put('update/{id}', [FormulaController::class, 'update'])->name('iku-formulasi.update');
        Route::get('destroy/{id}', [FormulaController::class, 'destroy'])->name('iku-formulasi.destroy');
    });
});
