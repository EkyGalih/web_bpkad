<?php

use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SubPagesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'pages'], function () {
            Route::get('/', [PagesController::class, 'index'])->name('pages-admin.index');
            Route::get('create', [PagesController::class, 'create'])->name('pages-admin.create');
            Route::post('store', [PagesController::class, 'store'])->name('pages-admin.store');
            Route::get('edit/{page}', [PagesController::class, 'edit'])->name('pages-admin.edit');
            Route::put('update/{page}', [PagesController::class, 'update'])->name('pages-admin.update');
            Route::get('restore/{page}', [PagesController::class, 'restore'])->name('pages-admin.restore');
            Route::get('destroy/{page}', [PagesController::class, 'destroy'])->name('pages-admin.destroy');
            Route::get('delete/{page}', [PagesController::class, 'delete'])->name('pages-admin.delete');
            Route::get('clear', [PagesController::class, 'delete'])->name('pages-admin.clear');
        });

        Route::group(['prefix' => 'sub-pages'], function () {
            Route::get('/', [SubPagesController::class, 'index'])->name('subpages-admin.index');
            Route::get('create', [SubPagesController::class, 'create'])->name('subpages-admin.create');
            Route::post('store', [SubPagesController::class, 'store'])->name('subpages-admin.store');
            Route::get('edit/{subpage}', [SubPagesController::class, 'edit'])->name('subpages-admin.edit');
            Route::put('update/{subpage}', [SubPagesController::class, 'update'])->name('subpages-admin.update');
            Route::get('restore/{subpage}', [SubPagesController::class, 'restore'])->name('subpages-admin.restore');
            Route::get('destroy/{subpage}', [SubPagesController::class, 'destroy'])->name('subpages-admin.destroy');
            Route::get('delete/{subpage}', [SubPagesController::class, 'delete'])->name('subpages-admin.delete');
            Route::get('clear', [SubPagesController::class, 'clear'])->name('subpages-admin.clear');
        });
    });
});
