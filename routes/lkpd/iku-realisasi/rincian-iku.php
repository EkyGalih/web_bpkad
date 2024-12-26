<?php

use App\Http\Controllers\Admin\IkuRealisasi\RincianIkuController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'Rincian-Iku'], function () {
        Route::get('/', [RincianIkuController::class, 'index'])->name('rincian-iku-admin');
        Route::get('create', [RincianIkuController::class, 'create'])->name('rincian-iku-admin.create');
        Route::post('store', [RincianIkuController::class, 'store'])->name('rincian-iku-admin.store');
        Route::get('edit/{id}', [RincianIkuController::class, 'edit'])->name('rincian-iku-admin.edit');
        Route::put('update/{id}', [RincianIkuController::class, 'update'])->name('rincian-iku-admin.update');
        Route::get('show/{id}', [RincianIkuController::class, 'show'])->name('rincian-iku-admin.show');
        Route::get('destroy/{id}', [RincianIkuController::class, 'destroy'])->name('rincian-iku-admin.destroy');
        Route::post('import', [RincianIkuController::class, 'import'])->name('rincian-iku-admin.import');
        Route::post('upload', [RincianIkuController::class, 'upload'])->name('rincian-iku-admin.upload');
    });
});
