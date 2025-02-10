<?php

use App\Http\Controllers\Admin\Api\IkuRealisasiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'iku-realisasi'], function () {
    Route::get('getFormulasi/{id}', [IkuRealisasiController::class, 'getFormulasi']);
    Route::get('formulaDetail/{id}', [IkuRealisasiController::class, 'formulaDetail']);
});
