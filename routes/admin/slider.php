<?php

use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'data-informasi'], function () {
            Route::group(['prefix' => 'slider'], function () {
                Route::get('/', [SliderController::class, 'index'])->name('slider.index');
                Route::get('create', [SliderController::class, 'create'])->name('slider.create');
                Route::post('store', [SliderController::class, 'store'])->name('slider.store');
                Route::get('edit/{slider}', [SliderController::class, 'edit'])->name('slider.edit');
                Route::put('update/{slider}', [SliderController::class, 'update'])->name('slider.update');
                Route::get('restore/{slider}', [SliderController::class, 'restore'])->name('slider.restore');
                Route::get('destroy/{slider}', [SliderController::class, 'destroy'])->name('slider.destroy');
                Route::get('delete/{slider}', [SliderController::class, 'delete'])->name('slider.delete');
                Route::get('clear', [SliderController::class, 'clear'])->name('slider.clear');
            });
        });
    });
});
