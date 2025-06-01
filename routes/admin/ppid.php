<?php

use App\Http\Controllers\Admin\PPID\KIPController;
use App\Http\Controllers\Admin\PPID\StrukturController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'ppid-kip'], function () {
            Route::get('/', [KIPController::class, 'index'])->name('ppid-kip.index');
            Route::get('create', [KIPController::class, 'create'])->name('ppid-kip.create');
            Route::post('store', [KIPController::class, 'store'])->name('ppid-kip.store');
            Route::get('edit/{kip}', [KIPController::class, 'edit'])->name('ppid-kip.edit');
            Route::put('update/{kip}', [KIPController::class, 'update'])->name('ppid-kip.update');
            Route::get('agenda', [KIPController::class, 'agenda'])->name('ppid-kip.agenda');
            Route::get('destroy/{kip}', [KIPController::class, 'destroy'])->name('ppid-kip.destroy');
            Route::get('delete/{kip}', [KIPController::class, 'delete'])->name('ppid-kip.delete');
            Route::get('clear', [KIPController::class, 'clear'])->name('ppid-kip.clear');
        });

        Route::group(['prefix' => 'ppid-struktur'], function () {
            Route::get('/', [StrukturController::class, 'index'])->name('ppid-struktur.index');
            Route::get('create', [StrukturController::class, 'create'])->name('ppid-struktur.create');
            Route::post('store', [StrukturController::class, 'store'])->name('ppid-struktur.store');
            Route::get('edit/{id}', [StrukturController::class, 'edit'])->name('ppid-struktur.edit');
            Route::put('update/{id}', [StrukturController::class, 'update'])->name('ppid-struktur.update');
            Route::get('destroy/{id}', [StrukturController::class, 'destroy'])->name('ppid-struktur.delete');
        });
    });
});
