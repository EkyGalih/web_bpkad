<?php

use App\Http\Controllers\Admin\WebsiteSettingsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
    Route::group(['prefix' => 'website-settings'], function () {
        Route::get('/', [WebsiteSettingsController::class, 'index'])->name('settings');
        Route::post('/update', [WebsiteSettingsController::class, 'update'])->name('settings.update');
        Route::get('/edit', [WebsiteSettingsController::class, 'edit'])->name('settings.edit');
    });
    });
});
