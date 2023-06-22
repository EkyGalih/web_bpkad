<?php

use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'Slider'], function () {
        Route::get('/', [SliderController::class, 'index'])->name('slider.index');
        Route::get('create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::put('update/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::get('restore/{id}', [SliderController::class, 'restore'])->name('slider.restore');
        Route::get('destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
        Route::get('delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
        Route::get('clear', [SliderController::class, 'clear'])->name('slider.clear');
    });
});
