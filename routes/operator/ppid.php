<?php

use App\Http\Controllers\Operator\PPID\KIPController;
use App\Http\Controllers\Operator\PPID\StrukturController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'ppid-kip'], function () {
        Route::get('/', [KIPController::class, 'index'])->name('ppid-op-kip.index');
        Route::get('create', [KIPController::class, 'create'])->name('ppid-op-kip.create');
        Route::post('store', [KIPController::class, 'store'])->name('ppid-op-kip.store');
        Route::get('edit/{id}', [KIPController::class, 'edit'])->name('ppid-op-kip.edit');
        Route::put('update/{id}', [KIPController::class, 'update'])->name('ppid-op-kip.update');
        Route::get('destroy/{id}', [KIPController::class, 'destroy'])->name('ppid-op-kip.destroy');
    });

    Route::group(['prefix' => 'ppid-struktur'], function () {
        Route::get('/', [StrukturController::class, 'index'])->name('ppid-op-struktur.index');
        Route::get('create', [StrukturController::class, 'create'])->name('ppid-op-struktur.create');
        Route::post('store', [StrukturController::class, 'store'])->name('ppid-op-struktur.store');
        Route::get('edit/{id}', [StrukturController::class, 'edit'])->name('ppid-op-struktur.edit');
        Route::put('update/{id}', [StrukturController::class, 'update'])->name('ppid-op-struktur.update');
        Route::get('destroy/{id}', [StrukturController::class, 'destroy'])->name('ppid-op-struktur.delete');
    });
});
