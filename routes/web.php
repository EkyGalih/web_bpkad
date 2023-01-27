<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login.store');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('404', [HomeController::class, '_NotFound'])->name('not_found.client');

Route::group(['prefix' => 'bpkad', 'middleware' => 'auth'], function () {
    Route::get('/home', [AdminHomeController::class, 'dashboard'])->name('sso.dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('404', [AdminController::class, '_NotFound'])->name('not_found.server');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('show/{id?}', [HomeController::class, 'show'])->name('client.show');
});

Route::group(['prefix' => 'Pages'], function () {
    Route::get('show/{id?}', [HomeController::class, 'ShowPages'])->name('client.show_pages');
});

Route::group(['prefix' => 'SubPages'], function () {
    Route::get('show/{id?}', [HomeController::class, 'ShowSubPages'])->name('client.show_sub_pages');
});
