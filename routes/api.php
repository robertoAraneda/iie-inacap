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

Route::get('/collection/categorias/all', 'CollectionsController@categoryCollectionActive');

Route::get('/collection/cursos/all', 'CollectionsController@courseCollectionActive');

Route::get('/collection/actividades/all', 'CollectionsController@activitiesCollectionActive');

Route::get('/collection/inscrito-actividad/filtered', 'CollectionsController@activityCourseRegisteredUserActive');

Route::get('/collection/inscrito/all', 'CollectionsController@registeredUserActiveInit');



Route::get('/collection/inscrito-actividad/all', 'CollectionsController@activityCourseRegisteredUserActiveInit');

Route::get('/collection/inscrito/filtered', 'CollectionsController@registeredUserActive');



//optimización de consultas

Route::get('/course/{idcourseMoodle}/users', 'CollectionsController@findUsersByCourse');
Route::get('/course/{idMoodle}', 'CollectionsController@findCourseByIdMoodle');

Route::get('/course/{idCourse}/activities', 'CollectionsController@findActivitiesByCourse');

Route::get('/users/{iduser}/courses/{idCourse}/activities', 'CollectionsController@findActivitiesByUser');

Route::get('/activities/{idActviityMoodle}', 'CollectionsController@findActivityByIdMoodle');
