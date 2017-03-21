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

// JWT Auth
Route::post('auth/login', 'Auth\AuthController@login');
Route::post('auth/register', 'Auth\AuthController@register');

Route::post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
Route::get('auth/password/verify', 'Auth\PasswordResetController@verify');
Route::post('auth/password/reset', 'Auth\PasswordResetController@reset');

//protected API routes with JWT (must be logged in)
Route::group(['prefix' => 'user'], function()
{
	Route::get('', ['uses' => 'UserController@allUsers']);
	Route::get('{id}', ['uses' => 'UserController@getUser']);
});
Route::group(['prefix' => 'uploader'], function()
{
	//Route::get('', ['uses' => 'UploaderController@uploadFile']);
	Route::post('{id}', ['uses' => 'UploaderController@uploadFile']);
});
Route::group(['prefix' => 'downloader'], function()
{
	//Route::get('', ['uses' => 'UploaderController@uploadFile']);
	Route::get('{id}', ['uses' => 'DownloaderController@donwloadFile']);
});
Route::resource('grupo', 'GrupoController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('subgrupo', 'SubgrupoController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('caracteristica', 'CaracteristicaController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('marca', 'MarcaController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('modelo', 'ModeloController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('municipio', 'MunicipioController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('oficialia', 'OficialiaController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('area', 'AreaController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('responsable', 'ResponsableController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('inventario', 'InventarioController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
Route::resource('resguardo', 'ResguardoController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

//unprotected API routes, no JWT (must not be logged in)