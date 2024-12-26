<?php

use App\Http\Controllers\Admin\DivisiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::group(['prefix' => 'bidang'], function(){
        Route::get('/', [DivisiController::class, 'index'])->name('admin-divisi');
        Route::post('store', [DivisiController::class, 'store'])->name('admin-divisi.store');
        Route::put('update/{id}', [DivisiController::class, 'update'])->name('admin-divisi.update');
        Route::get('destroy/{id}', [DivisiController::class, 'destroy'])->name('admin-divisi.destroy');
    });
});
