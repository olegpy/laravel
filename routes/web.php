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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::group(['as' => 'proposals.'], function () {
    Route::get('/', 'ProposalController@index')->name('index');
//    Route::get('', 'UserController@edit')->name('edit')->where('user', "[0-9]+");
//    Route::put('', 'UserController@update')->name('update')->where('user', "[0-9]+");
//    Route::put('company', 'UserController@updateCompany')->name('update.company')->where('user', "[0-9]+");
//    Route::put('image', 'UserController@updateImage')->name('update.image')->where('user', "[0-9]+");
});
//Route::group();
//Route::get('/', 'ProposalController@index')->name('index');
