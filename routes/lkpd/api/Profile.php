<?php

use App\Http\Controllers\Admin\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile'], function() {
    Route::get('getSandi/{id}', [ProfileController::class, 'getSandi']);
});
