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
    return view('masterLogIn');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('user', 'UserController');

Route::resource('acccesslog', 'AccessLogController');

Route::resource('company', 'CompanyController');

Route::resource('visitor', 'VisitorController');

Route::resource('visitorType', 'VisitorTypeController');
