<?php

use App\Http\Controllers\Admin\SubKodeRekeningController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'sub-kode-rekening'], function () {
        Route::get('/{id}', [SubKodeRekeningController::class, 'index'])->name('sub-kode-admin');
        Route::post('store', [SubKodeRekeningController::class, 'store'])->name('sub-kode-admin.store');
        Route::get('edit/{id}', [SubKodeRekeningController::class, 'edit'])->name('sub-kode-admin.edit');
        Route::put('update/{id}', [SubKodeRekeningController::class, 'update'])->name('sub-kode-admin.update');
        Route::get('destroy/{id}', [SubKodeRekeningController::class, 'destroy'])->name('sub-kode-admin.destroy');
    });
});
