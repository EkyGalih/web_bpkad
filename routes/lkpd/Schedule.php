<?php

use App\Http\Controllers\Admin\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::group(['prefix' => 'jadwal-pimpinan'], function() {
        Route::get('/', [ScheduleController::class, 'index'])->name('admin.jadwal');
        Route::post('store', [ScheduleController::class, 'store'])->name('admin.jadwalStore');
        Route::put('update/{id}', [ScheduleController::class, 'update'])->name('admin.jadwalUpdate');
        Route::post('status/{id}', [ScheduleController::class, 'status'])->name('admin.jadwalStatus');
    });
});
