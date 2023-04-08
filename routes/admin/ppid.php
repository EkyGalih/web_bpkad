<?php

use App\Http\Controllers\Admin\PPID\KIPController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'ppid-kip'], function () {
        Route::get('/', [KIPController::class, 'index'])->name('ppid-kip.index');
        Route::get('create', [KIPController::class, 'create'])->name('ppid-kip.create');
        Route::post('store', [KIPController::class, 'store'])->name('ppid-kip.store');
        Route::get('edit/{id}', [KIPController::class, 'edit'])->name('ppid-kip.edit');
        Route::put('update/{id}', [KIPController::class, 'update'])->name('ppid-kip.update');
        Route::get('destroy/{id}', [KIPController::class, 'destroy'])->name('ppid-kip.destroy');
    });
});
