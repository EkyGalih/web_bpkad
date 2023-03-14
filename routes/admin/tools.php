<?php

use App\Http\Controllers\Admin\Tools\AddressController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'tools-address'], function () {
        Route::get('/', [AddressController::class, 'index'])->name('tools-address');
    });
});
