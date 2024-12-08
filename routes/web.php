<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PPID\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\ArtikelController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\LaporanPermohonanMasyarakatController;
use App\Http\Controllers\Client\PegawaiController;
use App\Http\Controllers\Client\PostsController;
use App\Http\Controllers\Client\PpidKipController;
use App\Http\Controllers\Operator\OperatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login.store');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('404', [HomeController::class, '_NotFound'])->name('not_found.client');
Route::get('bpkad-olympic', [HomeController::class, 'olympic'])->name('bpkad-olympic');

Route::get('/auth/redirect', 'Auth\LoginController@redirectToProvider')->name('login.google');
Route::get('/auth/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['prefix' => 'bpkad', 'middleware' => 'auth'], function () {
    Route::get('/home', [AdminHomeController::class, 'dashboard'])->name('sso.dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
});

Route::group(['prefix' => 'operator', 'middleware' => ['auth', 'operator']], function () {
    Route::get('/', [OperatorController::class, 'index'])->name('operator');
});

Route::group(['prefix' => 'berita'], function () {
    Route::get('/', [HomeController::class, 'post'])->name('post.index');
    Route::get('tags/{tags?}', [HomeController::class, 'PostTag'])->name('post.tags');
    Route::get('like/{id}', [PostsController::class, 'like'])->name('post.like');
    Route::post('comment/{id}', [PostsController::class, 'comment'])->name('post.comment');
    Route::post('search', [PostsController::class, 'search'])->name('post.search');
});

Route::get('/posts/{category?}/{slug?}', [HomeController::class, 'show'])->name('post.show');

Route::group(['prefix' => 'artikel'], function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('detail/{token1?}/{id?}/{token2?}', [ArtikelController::class, 'show'])->name('artikel.show');
});

Route::get('/pages/{slug?}', [HomeController::class, 'pages'])->name('client.pages');

Route::get('/pages/sub-pages/{slug?}', [HomeController::class, 'sub_pages'])->name('client.sub_pages');

Route::get('/check-slug', [AdminController::class, 'checkSlugPage']);
Route::get('/check-slug-sub', [AdminController::class, 'checkSlugSubPage']);

Route::group(['prefix' => 'Permohonan_dan_Pengaduan'], function () {
    Route::get('/', [LaporanPermohonanMasyarakatController::class, 'index'])->name('faq.index');
    Route::post('store', [LaporanPermohonanMasyarakatController::class, 'store'])->name('faq.store');
    Route::post('show', [LaporanPermohonanMasyarakatController::class, 'show'])->name('faq.show');
    Route::put('update/{id}', [LaporanPermohonanMasyarakatController::class, 'update'])->name('faq.update');
    Route::get('destroy/{id}', [LaporanPermohonanMasyarakatController::class, 'destroy'])->name('faq.destroy');
});

Route::group(['prefix' => 'Profile/Profile-Pejabat'], function () {
    Route::get('/', [PegawaiController::class, 'ProfilePejabat'])->name('profile.profile-pejabat');
});

Route::group(['prefix' => 'Profile/Data-Pegawai-Bpkad'], function () {
    Route::get('/', [PegawaiController::class, 'pegawai'])->name('profile.data-pegawai');
});

Route::group(['prefix' => 'PPID'], function () {
    Route::group(['prefix' => 'Klasifikasi-Informasi-Publik'], function () {
        Route::get('/', [PpidKipController::class, 'index'])->name('ppid-kip');
        Route::get('info-berkala/{query?}', [PpidKipController::class, 'searchBerkala'])->name('ppid-kip.search_berkala');
        Route::get('/generate-pdf/{id}', [PPidKipController::class, 'generatePDF'])->name('ppid-kip.generate_pdf');
    });

    Route::group(['prefix' => 'Profile-PPID'], function () {
        Route::group(['prefix' => 'Struktur-Organisasi-PPID'], function () {
            Route::get('/', [ProfileController::class, 'struktur'])->name('profile.struktur-organisasi');
        });
    });

    Route::group(['prefix' => 'agenda'], function () {
        Route::get('/{tahun?}', [PpidKipController::class, 'agenda'])->name('ppid.agenda');
    });
});


// google analytycs
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'analytycs'], function () {
        Route::get('/statistik-pengunjung', [AnalyticsController::class, 'index'])->name('admin.analytics');
    });
});
