<?php

use App\Http\Controllers\Admin\IkuRealisasi\ProgramAnggaranIkuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::group(['prefix' => 'program-anggaran-iku'], function(){
        Route::post('store', [ProgramAnggaranIkuController::class, 'store'])->name('program-anggaran-iku.store');
        Route::put('update/{id}', [ProgramAnggaranIkuController::class, 'update'])->name('program-anggaran-iku.update');
        Route::get('destroy/{id}', [ProgramAnggaranIkuController::class, 'destroy'])->name('program-anggaran-iku.destroy');
    });
});
