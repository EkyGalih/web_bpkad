<?php

use App\Http\Controllers\Admin\PengumumanController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'data-informasi'], function () {
            Route::group(['prefix' => 'pengumuman'], function () {
                Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.index');
                Route::get('create', [PengumumanController::class, 'create'])->name('pengumuman.create');
                Route::post('store', [PengumumanController::class, 'store'])->name('pengumuman.store');
                Route::get('edit/{pengumuman}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
                Route::put('update/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update');
                Route::get('destroy/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
            });
        });
    });
});
