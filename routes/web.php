<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LaporanPermohonanMasyarakatController;
use App\Http\Controllers\Client\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login.store');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('404', [HomeController::class, '_NotFound'])->name('not_found.client');

Route::get('/auth/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['prefix' => 'bpkad', 'middleware' => 'auth'], function () {
    Route::get('/home', [AdminHomeController::class, 'dashboard'])->name('sso.dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('404', [AdminController::class, '_NotFound'])->name('not_found.server');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('show/{id?}', [HomeController::class, 'show'])->name('client.show');
    Route::get('like/{id}', [PostsController::class, 'like'])->name('post.like');
    Route::post('comment/{id}', [PostsController::class, 'comment'])->name('post.comment');
});

Route::group(['prefix' => 'Pages'], function () {
    Route::get('show/{id?}', [HomeController::class, 'ShowPages'])->name('client.show_pages');
});

Route::group(['prefix' => 'SubPages'], function () {
    Route::get('show/{id?}', [HomeController::class, 'ShowSubPages'])->name('client.show_sub_pages');
});

Route::group(['prefix' => 'Permohonan_dan_Pengaduan'], function () {
    Route::get('/', [LaporanPermohonanMasyarakatController::class, 'index'])->name('faq.index');
    Route::post('store', [LaporanPermohonanMasyarakatController::class, 'store'])->name('faq.store');
    Route::put('update/{id}', [LaporanPermohonanMasyarakatController::class, 'update'])->name('faq.update');
});
