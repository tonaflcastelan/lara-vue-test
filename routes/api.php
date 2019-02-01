<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::group(['middleware' => 'jwt.auth'], function(){
	Route::get('auth/user', 'AuthController@user');
	Route::post('auth/logout', 'AuthController@logout');

	/* Roles */
	Route::get('/roles', 'RolesController@index');
	Route::get('/roles/{id}/edit', 'RolesController@edit');
	Route::put('/roles/update/{id}', 'RolesController@update');
	Route::post('/roles/create', 'RolesController@store');
    Route::delete('/roles/delete/{id}', 'RolesController@destroy');

    /* Users */
    Route::get('/users', 'UsersController@index');
    Route::post('/users/create', 'UsersController@store');
    Route::get('/users/{id}/edit', 'UsersController@edit');
	Route::post('/users/update/{id}', 'UsersController@update');
	Route::delete('/users/delete/{id}', 'UsersController@destroy');
});

Route::group(['middleware' => 'jwt.refresh'], function(){
	Route::get('auth/refresh', 'AuthController@refresh');
});
