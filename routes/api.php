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

//protected API routes with JWT (logged in required)
Route::group(['prefix' => 'user'], function()
{
	Route::get('', ['uses' => 'UserController@allUsers']);
	Route::get('{id}', ['uses' => 'UserController@getUser']);
});

Route::group(['prefix' => 'uploader'], function()
{
	Route::post('{id}', ['uses' => 'UploaderController@uploadFile']);
	Route::delete('{id}', ['uses' => 'UploaderController@deleteFile']);
});
Route::group(['prefix' => 'downloader'], function()
{
	Route::get('{id}', ['uses' => 'DownloaderController@donwloadFile']);
});
//protected API resource routes with JWT (logged in required)
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

// hiden -- remove these routes in production
Route::resource('evidencia', 'EvidenciaController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
// --

//unprotected API routes, no JWT (logged in not required)
// --