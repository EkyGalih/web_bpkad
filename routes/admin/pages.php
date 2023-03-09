<?php

use App\Http\Controllers\Admin\PagesController;
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
});
