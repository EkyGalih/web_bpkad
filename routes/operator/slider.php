<?php

use App\Http\Controllers\Operator\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::group(['prefix' => 'Slider'], function () {
        Route::get('/', [SliderController::class, 'index'])->name('slider-op.index');
        Route::get('create', [SliderController::class, 'create'])->name('slider-op.create');
        Route::post('store', [SliderController::class, 'store'])->name('slider-op.store');
        Route::get('edit/{id}', [SliderController::class, 'edit'])->name('slider-op.edit');
        Route::put('update/{id}', [SliderController::class, 'update'])->name('slider-op.update');
        Route::get('destroy/{id}', [SliderController::class, 'destroy'])->name('slider-op.destroy');
    });
});
