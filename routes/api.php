<?php

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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	$api->post('register', 'App\Http\Controllers\Api\AuthenticateController@register');
	$api->post('login', 'App\Http\Controllers\Api\AuthenticateController@login');
});

$api->version('v1', ['middleware' => 'api.auth'], function ($api) {
	$api->group(['prefix' => 'system'], function ($api) {
		$api->resource('permission', 'App\Http\Controllers\Api\System\PermissionController');
		$api->resource('role', 'App\Http\Controllers\Api\System\RoleController');
	});
	$api->resource('user', 'App\Http\Controllers\Api\UserController');
});
