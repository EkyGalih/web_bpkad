<?php

use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SubPagesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [PagesController::class, 'index'])->name('pages-admin.index');
        Route::get('create', [PagesController::class, 'create'])->name('pages-admin.create');
        Route::post('store', [PagesController::class, 'store'])->name('pages-admin.store');
        Route::get('edit/{id}', [PagesController::class, 'edit'])->name('pages-admin.edit');
        Route::put('update/{id}', [PagesController::class, 'update'])->name('pages-admin.update');
    Route::get('destroy/{id}', [PagesController::class, 'destroy'])->name('pages-admin.destroy');
    });

    Route::group(['prefix' => 'sub-pages'], function () {
        Route::get('/', [SubPagesController::class, 'index'])->name('subpages-admin.index');
        Route::get('create', [SubPagesController::class, 'create'])->name('subpages-admin.create');
        Route::post('store', [SubPagesController::class, 'store'])->name('subpages-admin.store');
        Route::get('edit/{id}', [SubPagesController::class, 'edit'])->name('subpages-admin.edit');
        Route::put('update/{id}', [SubPagesController::class, 'update'])->name('subpages-admin.update');
    Route::get('destroy/{id}', [SubPagesController::class, 'destroy'])->name('subpages-admin.destroy');
    });
});
