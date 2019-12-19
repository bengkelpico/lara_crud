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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pola/jumlah', 'PolaController@index')->name('jumlah');
Route::get('/pola/star', 'PolaController@star')->name('star');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
