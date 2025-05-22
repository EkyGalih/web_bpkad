<?php

use App\Http\Controllers\Operator\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('post-op.index');
        Route::get('create', [PostController::class, 'create'])->name('post-op.create');
        Route::post('post', [PostController::class, 'store'])->name('post-op.store');
        Route::get('edit/{id}', [PostController::class, 'edit'])->name('post-op.edit');
        Route::put('update/{id}', [PostController::class, 'update'])->name('post-op.update');
        Route::get('destroy/{id}', [PostController::class, 'destroy'])->name('post-op.destroy');
    });
});
