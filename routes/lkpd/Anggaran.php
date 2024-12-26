<?php

use App\Http\Controllers\Admin\AnggaranController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function() {
    Route::group(['prefix' => 'anggaran'], function() {
        Route::get('/{tahun?}', [AnggaranController::class, 'index'])->name('apbd');
        Route::post('store', [AnggaranController::class, 'store'])->name('apbd.store');
        Route::get('edit/{id}', [AnggaranController::class, 'edit'])->name('apbd.edit');
        Route::put('update/{id}', [AnggaranController::class, 'update'])->name('apbd.update');
        Route::get('destroy/{id}', [AnggaranController::class, 'destroy'])->name('apbd.destroy');
        Route::post('import', [AnggaranController::class, 'import'])->name('apbd.import');
    });
});
