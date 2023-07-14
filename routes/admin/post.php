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
        Route::get('restore/{id}', [PostController::class, 'restore'])->name('post-admin.restore');
        Route::get('destroy/{id}', [PostController::class, 'destroy'])->name('post-admin.destroy');
        Route::get('delete/{id}', [PostController::class, 'delete'])->name('post-admin.delete');
        Route::get('clear', [PostController::class, 'clear'])->name('post-admin.clear');
        Route::get('agenda/{id}', [PostController::class, 'agenda'])->name('post-admin.agenda');
    });
});
