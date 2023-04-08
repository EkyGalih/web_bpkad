<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('post-admin.index');
        Route::get('create', [PostController::class, 'create'])->name('post-admin.create');
        Route::post('post', [PostController::class, 'store'])->name('post-admin.store');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('post-admin.edit');
        Route::put('update/{id}', [PostController::class, 'update'])->name('post-admin.update');
        Route::get('destroy/{id}', [PostController::class, 'destroy'])->name('post-admin.destroy');
    });
});
