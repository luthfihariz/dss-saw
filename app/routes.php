<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'auth'), function(){
	Route::resource('/', 'DashboardController');
	Route::resource('peserta', 'PesertaController');
	Route::resource('fullday', 'FulldayController');
	Route::resource('fullday_data', 'FulldayController@get_data');
	Route::resource('fullday_update', 'FulldayController@update_data');
	Route::resource('reguler', 'RegulerController');
	Route::resource('reguler_data', 'RegulerController@get_data');
	Route::resource('reguler_update', 'RegulerController@update_data');
	Route::resource('search','PesertaController@doSearch');
	Route::resource('logout','LoginController@doLogout');
});

Route::resource('login', 'LoginController');
Route::post('login', array('uses' => 'LoginController@doLogin'));