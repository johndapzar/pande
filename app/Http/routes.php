<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
		Route::resource('chiefengineer','ChiefEngineerController');
		Route::resource('officecircle','OfficeCircleController');
		Route::resource('officedivision','OfficeDivisionController');
		Route::get('subdivision','OfficeSubDivisionController@subdivision');
		Route::resource('officesubdivision','OfficeSubDivisionController');
	});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
