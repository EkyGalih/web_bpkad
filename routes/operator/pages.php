<?php

use App\Http\Controllers\Operator\PagesController;
use App\Http\Controllers\Operator\SubPagesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', [PagesController::class, 'index'])->name('pages-op.index');
        Route::get('edit/{id}', [PagesController::class, 'edit'])->name('pages-op.edit');
        Route::put('update/{id}', [PagesController::class, 'update'])->name('pages-op.update');
    Route::get('destroy/{id}', [PagesController::class, 'destroy'])->name('pages-op.destroy');
    });

    Route::group(['prefix' => 'sub-pages'], function () {
        Route::get('/', [SubPagesController::class, 'index'])->name('subpages-op.index');
        Route::get('edit/{id}', [SubPagesController::class, 'edit'])->name('subpages-op.edit');
        Route::put('update/{id}', [SubPagesController::class, 'update'])->name('subpages-op.update');
    Route::get('destroy/{id}', [SubPagesController::class, 'destroy'])->name('subpages-op.destroy');
    });
});
