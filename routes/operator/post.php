<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'web/post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('post-operator.index');
        Route::get('create', [PostController::class, 'create'])->name('post-operator.create');
        Route::post('post', [PostController::class, 'store'])->name('post-operator.store');
        Route::get('edit/{post}', [PostController::class, 'edit'])->name('post-operator.edit');
        Route::put('update/{post}', [PostController::class, 'update'])->name('post-operator.update');
        Route::get('restore/{post}', [PostController::class, 'restore'])->name('post-operator.restore');
        Route::get('destroy/{post}', [PostController::class, 'destroy'])->name('post-operator.destroy');
        Route::get('delete/{post}', [PostController::class, 'delete'])->name('post-operator.delete');
        Route::get('clear', [PostController::class, 'clear'])->name('post-operator.clear');
        Route::get('agenda/{post}', [PostController::class, 'agenda'])->name('post-operator.agenda');
    });
});
