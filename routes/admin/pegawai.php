<?php

use App\Http\Controllers\Admin\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'pegawai'], function () {
            Route::get('/', [PegawaiController::class, 'index'])->name('admin-pegawai.index');
            Route::get('create', [PegawaiController::class, 'create'])->name('admin-pegawai.create');
            Route::post('store', [PegawaiController::class, 'store'])->name('admin-pegawai.store');
            Route::get('edit/{id}', [PegawaiController::class, 'edit'])->name('admin-pegawai.edit');
            Route::put('update/{id}', [PegawaiController::class, 'update'])->name('admin-pegawai.update');
            Route::get('detail-pegawai/{id}', [PegawaiController::class, 'show'])->name('admin-pegawai.show');
            Route::get('destroy/{id}', [PegawaiController::class, 'destroy'])->name('admin-pegawai.destroy');
        });
    });
});
