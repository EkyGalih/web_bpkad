<?php

use App\Http\Controllers\LKPD\Admin\IkuRealisasi\RincianIkuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'lkpd'], function () {
        Route::group(['prefix' => 'Rincian-Iku'], function () {
            Route::get('/', [RincianIkuController::class, 'index'])->name('rincian-iku');
            Route::get('create', [RincianIkuController::class, 'create'])->name('rincian-iku.create');
            Route::post('store', [RincianIkuController::class, 'store'])->name('rincian-iku.store');
            Route::get('edit/{id}', [RincianIkuController::class, 'edit'])->name('rincian-iku.edit');
            Route::put('update/{id}', [RincianIkuController::class, 'update'])->name('rincian-iku.update');
            Route::get('show/{id}', [RincianIkuController::class, 'show'])->name('rincian-iku.show');
            Route::get('destroy/{id}', [RincianIkuController::class, 'destroy'])->name('rincian-iku.destroy');
            Route::post('import', [RincianIkuController::class, 'import'])->name('rincian-iku.import');
            Route::post('upload', [RincianIkuController::class, 'upload'])->name('rincian-iku.upload');
        });
    });
});
