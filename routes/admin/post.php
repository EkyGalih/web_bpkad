<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'post'], function () {
            Route::get('/', [PostController::class, 'index'])->name('post-admin.index');
            Route::get('create', [PostController::class, 'create'])->name('post-admin.create');
            Route::post('post', [PostController::class, 'store'])->name('post-admin.store');
            Route::get('edit/{post}', [PostController::class, 'edit'])->name('post-admin.edit');
            Route::put('update/{post}', [PostController::class, 'update'])->name('post-admin.update');
            Route::get('restore/{post}', [PostController::class, 'restore'])->name('post-admin.restore');
            Route::get('destroy/{post}', [PostController::class, 'destroy'])->name('post-admin.destroy');
            Route::get('delete/{post}', [PostController::class, 'delete'])->name('post-admin.delete');
            Route::get('clear', [PostController::class, 'clear'])->name('post-admin.clear');
            Route::get('agenda/{post}', [PostController::class, 'agenda'])->name('post-admin.agenda');
        });
    });
});
