<?php

use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'Client\HomeController@index')->name('dashboard');
Route::get('masuk', 'Auth\LoginController@showLoginForm')->name('login.form');
Route::post('masuk', 'Auth\LoginController@login')->name('login.submit');
Route::get('keluar', 'Auth\LoginController@logout')->name('keluar');

Route::group(['prefix' => 'bpkad', 'middleware' => 'auth'], function () {
    Route::get('/home', 'Admin\HomeController@dashboard')->name('sso.dashboard');
});

Route::group(['prefix' => 'admin-bpkad', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin-bpkad');
    Route::get('/', 'Admin\AdminController@beranda')->name('beranda');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('show/{id?}', [HomeController::class, 'show'])->name('client.show');
});
