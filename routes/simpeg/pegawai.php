<?php

use App\Http\Controllers\Simpeg\Admin\PegawaiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'simpeg'], function () {
        Route::group(['prefix' => 'pegawai'], function () {
            Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');
            Route::get('create', [PegawaiController::class, 'create'])->name('pegawai.create');
            Route::post('store', [PegawaiController::class, 'store'])->name('pegawai.store');
            Route::get('edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
            Route::put('update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
            Route::get('detail-pegawai/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
            Route::get('/search', [PegawaiController::class, 'search'])->name('pegawai.search');
            Route::get('destroy/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
        });
    });
});
