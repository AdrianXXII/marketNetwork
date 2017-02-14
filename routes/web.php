<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function() {
    Route::auth();

    Route::get('/', 'HomeController@index');

    Route::get('/address', 'MembersController@index')->name('member.index');
    Route::get('/address/create', 'MembersController@create')->name('member.create');
    Route::get('/address/{id}/edit', 'MembersController@edit')->name('member.edit');
    Route::post('/address', 'MembersController@store')->name('member.save');
    Route::delete('/address/{id}', 'MembersController@destroy')->name('member.delete');
    Route::put('/address/{id}', 'MembersController@update')->name('member.update');

    Route::get('/location', 'LocationController@index')->name('location.index');
    Route::get('/location/create', 'LocationController@create')->name('location.create');
    Route::post('/location', 'LocationController@store')->name('location.save');
    Route::delete('/location/{id}', 'LocationController@destroy')->name('location.delete');
    Route::put('/location/{id}', 'LocationController@update')->name('location.update');
    Route::get('/location/{id}/edit', 'LocationController@edit')->name('location.edit');

});

Auth::routes();

