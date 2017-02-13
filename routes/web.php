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
    Route::get('/address/s/{search}', 'MembersController@index')->name('member.search');
    Route::post('/address/save', 'MembersController@store')->name('member.save');
    Route::get('/address/create', 'MembersController@create');
    Route::get('/address/{id}/edit', 'MembersController@edit')->name('member.edit');
    Route::put('/address/{id}', 'MembersController@update')->name('member.update');

});

Auth::routes();

