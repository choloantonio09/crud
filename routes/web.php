<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Http\Controllers\CreateController;



Route::get('/', 'CreateController@displayAll');

Route::get('/create',function (){
	return view('partial/addusers');
});

Route::post('/create/submit','CreateController@store'); // INSERT TO DB FUNCTION

Route::get('/displayUpdate','CreateController@displayUpdate'); // SHOW VALUES TO BE UPDATED

Route::post('/update','CreateController@update');

Route::get('delete/{id}','CreateController@delete'); //DELETE FUNCTION