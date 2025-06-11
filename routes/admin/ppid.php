<?php

use App\Http\Controllers\Admin\PPID\AgendaController;
use App\Http\Controllers\Admin\PPID\KIPController;
use App\Http\Controllers\Admin\PPID\StrukturController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web/ppid'], function () {
        Route::group(['prefix' => 'kip'], function () {
            Route::get('/', [KIPController::class, 'index'])->name('kip.index');
            Route::get('create', [KIPController::class, 'create'])->name('kip.create');
            Route::post('store', [KIPController::class, 'store'])->name('kip.store');
            Route::get('edit/{kip}', [KIPController::class, 'edit'])->name('kip.edit');
            Route::put('update/{kip}', [KIPController::class, 'update'])->name('kip.update');
            Route::get('restore/{kip}', [KIPController::class, 'restore'])->name('kip.restore');
            Route::get('destroy/{kip}', [KIPController::class, 'destroy'])->name('kip.destroy');
            Route::get('delete/{kip}', [KIPController::class, 'delete'])->name('kip.delete');
            Route::get('clear', [KIPController::class, 'clear'])->name('kip.clear');
            Route::get('view-pdf/{kip}', [KIPController::class, 'viewPDF'])->name('kip-admin.view_pdf');
            Route::get('download-pdf/{kip}', [KIPController::class, 'downloadPDF'])->name('kip-admin.download_pdf');
        });

        Route::group(['prefix' => 'agenda-pimpinan'], function () {
            Route::get('/', [AgendaController::class, 'index'])->name('agenda-pimpinan.index');
            Route::get('create', [AgendaController::class, 'create'])->name('agenda-pimpinan.create');
            Route::get('jadikan-agenda/{post}', [AgendaController::class, 'jadikanAgenda'])->name('agenda-pimpinan.jadikan_agenda');
            Route::get('destroy/{post}', [AgendaController::class, 'destroy'])->name('agenda-pimpinan.destroy');
        });

        Route::group(['prefix' => 'struktur-organisasi'], function () {
            Route::get('/', [StrukturController::class, 'index'])->name('struktur-organisasi.index');
            Route::get('create', [StrukturController::class, 'create'])->name('struktur-organisasi.create');
            Route::post('store', [StrukturController::class, 'store'])->name('struktur-organisasi.store');
            Route::get('edit/{ppid}', [StrukturController::class, 'edit'])->name('struktur-organisasi.edit');
            Route::put('update/{ppid}', [StrukturController::class, 'update'])->name('struktur-organisasi.update');
            Route::get('destroy/{ppid}', [StrukturController::class, 'destroy'])->name('struktur-organisasi.delete');
        });
    });
});
