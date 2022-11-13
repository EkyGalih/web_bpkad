<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('masuk', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('masuk', [LoginController::class, 'login'])->name('login.submit');
Route::get('keluar', [LoginController::class, 'logout'])->name('keluar');

Route::group(['prefix' => 'bpkad', 'middleware' => 'auth'], function () {
    Route::get('/home', [AdminHomeController::class, 'dashboard'])->name('sso.dashboard');
});

Route::group(['prefix' => 'admin-bpkad', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin-bpkad');
    Route::get('/', [AdminController::class, 'beranda'])->name('beranda');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('show/{id?}', [HomeController::class, 'show'])->name('client.show');
});
