<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/actividades', 'ActividadesController@index');
Route::get('/category', 'CategoryController@index');
Route::get('/cursos', 'CursosController@index');
Route::get('/inscrito-actividad', 'InscritoActividadController@index');
Route::get('/cursos/{id}', 'CursosController@show');
Route::get('/category/{id}', 'CategoryController@show');
Route::get('/inscrito-actividad/{id}', 'InscritoActividadController@show');
