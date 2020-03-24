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
Route::get('/inscritos', 'InscritosController@index');
Route::get('/plataforma', 'PlataformaController@index');
Route::get('/actividades/{id}', 'ActividadesController@show');
Route::get('/cursos/{id}', 'CursosController@show');
Route::get('/category/{id}', 'CategoryController@show');
Route::get('/inscrito-actividad/{id}', 'InscritoActividadController@show');
Route::get('/inscritos/{id}', 'InscritosController@show');
Route::get('/plataforma/{id}', 'PlataformaController@show');
Route::get('/collection/curso', 'CollectionsController@cursosCollection');
Route::get('/collection/plataforma', 'CollectionsController@plataformaCollection');
Route::get('/collection/course-detail/{id}', 'CollectionsController@courseDetail');
Route::get('/collection/actividades', 'CollectionsController@activitiesCollection');
Route::get('/collection/inscritos', 'CollectionsController@registeredUsersCollection');
Route::get('/collection/plataforma/active', 'CollectionsController@plataformaCollectionActive');
Route::get('/collection/categorias/active', 'CollectionsController@categoryCollectionActive');




Route::get('/collection/cursos/active', 'CollectionsController@courseCollectionActive');

Route::get('/collection/actividades/active', 'CollectionsController@activitiesCollectionActive');

Route::get('/collection/inscritos/active', 'CollectionsController@registeredUserActive');


Route::get('/collection/check', 'CollectionsController@registeredUserActivity');
