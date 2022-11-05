<?php

Route::group(['prefix' => 'pengguna', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'Auth\ManajemenUserController@index')->name('pengguna');
    Route::get('create', 'Auth\ManajemenUserController@create')->name('pengguna.tambah');
    Route::post('store', 'Auth\ManajemenUserController@store')->name('pengguna.store');
    Route::get('edit/{id}', 'Auth\ManajemenUserController@edit')->name('pengguna.ubah');
    Route::put('update/{id}', 'Auth\ManajemenUserController@update')->name('pengguna.update');
    Route::get('show/{id}', 'Auth\ManajemenUserController@show')->name('pengguna.show');
});