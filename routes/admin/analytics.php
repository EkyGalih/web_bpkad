<?php

use App\Http\Controllers\Admin\AnalyticsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['prefix' => 'web'], function () {
        Route::group(['prefix' => 'analytics'], function () {
            Route::get('/statistik-pengunjung', [AnalyticsController::class, 'index'])->name('admin.analytics');
            Route::get('/periode/{range}', [AnalyticsController::class, 'getAnalyticsData'])->name('admin.periode');
            Route::get('/pages', [AnalyticsController::class, 'getTopPages']);
            Route::get('/visits-by-country', [AnalyticsController::class, 'getVisitorsByCountry']);
            Route::get('/browser-device', [AnalyticsController::class, 'getBrowserAndDevice']);
        });
    });
});
