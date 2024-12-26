<?php

use App\Http\Controllers\Admin\Api\KodeRekeningController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'kode-rekening'], function () {
    Route::get('getOne', [KodeRekeningController::class, 'getOne']);
    Route::get('getSpesifikRekening/{id}', [KodeRekeningController::class, 'getSpesifikRekening']);
    Route::get('getRefRekening/{id}', [KodeRekeningController::class, 'getRefRekening']);
    Route::get('getRefGroup/{id}', [KodeRekeningController::class, 'getRefGroup']);
    Route::get('getRefSub/{id}', [KodeRekeningController::class, 'getRefSub']);
    Route::get('getRekening/{kode}', [KodeRekeningController::class, 'getRekening']);
    Route::get('getSubRekening/{kode}', [KodeRekeningController::class, 'getSubRekening']);
});
