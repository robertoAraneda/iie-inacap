<?php

namespace App\Http\Controllers;

use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SynchronizeController extends Controller
{

  public function synchronizeApp()
  {
    $response = Http::get('http://127.0.0.1:8000/api/collection/plataforma');

    $platforms = $response->json();

    $array = [];

    /**insertar plataformas */
    foreach ($platforms as $platform) {

      $platformController = new PlatformController();

      $searchPlatform = $platformController->findByDescription($platform['nombre']);

      if (!isset($searchPlatform)) {
        $platformController->store($platform);
      }
    }

    /**insertar categorias */
    foreach ($platforms as $platform) {

      $platformController = new PlatformController();

      $platformResponse = $platformController->findByDescription($platform['nombre']);

      foreach ($platform['categories'] as $category) {

        $categoryController = new CategoryController();

        $categorySearch = $categoryController->findByIdCategoryMoodle($category['idcategory']);

        if (!isset($categorySearch)) {

          $category['idplataforma'] = $platformResponse->id;

          $categoryController->store($category);
        } else {
          if ($category['idplataforma'] == $platform['idplataforma']) {

            $category['idplataforma'] = $platformResponse->id;

            $categoryController->store($category);
          }
        }
      }
    }

    /**insertar coursos */
    foreach ($platforms as $platform) {

      $platformController = new PlatformController();

      $platformResponse = $platformController->findByDescription($platform['nombre']);

      foreach ($platform['categories'] as $category) {

        $categoryController = new CategoryController();

        $categorySearch = $categoryController->findByIdCategoryMoodle($category['idcategory']);

        foreach ($category['coursesFormat'] as $course) {

          $courseController = new CourseController();

          $categoryResponse = $categoryController->findByIdPlatformAndCategoryMoodle($course['idcategory'], $platformResponse->id);

          $courseResponse = $courseController->findByIdCourseMoodle($course['idcurso']);

          if (($course['idcategory'] == $category['idcategory']) && ($course['idplataforma'] == $category['idplataforma'])) {

            if (!isset($courseResponse)) {

              $course['idcategory'] = $categoryResponse->id;

              $courseController->store($course);
            }
          }

          $array[] = $course;
        }
      }
    }

    $response2 = Http::get('http://127.0.0.1:8000/api/collection/actividades');

    $activities = $response2->json();

    /**insertar actividades */
    foreach ($activities as $activity) {

      $courseController = new CourseController();
      $activityController = new ActivityController();

      $course = $courseController->findByIdCourseMoodle($activity['curso']['idcurso']);

      $activitySearch = $activityController->findByIdActivityMoodle($activity['idmod']);

      if (!isset($activitySearch)) {
        $activity['idrcurso'] = $course->id;

        $activityController->store($activity);
      }
    }

    $response3 = Http::get('http://127.0.0.1:8000/api/collection/inscritos');

    $courseRegisteredUsersMoodle = $response3->json();


    /**insertar inscritos y cursos */
    foreach ($courseRegisteredUsersMoodle as $courseRegisteredUserMoodle) {
      $registeredUserController = new RegisteredUserController();

      $registeredUserSearch = $registeredUserController->findByIdRegisteredUserMoodle($courseRegisteredUserMoodle['iduser']);


      if (!isset($registeredUserSearch)) {

        $registeredUserSearch = $registeredUserController->store($courseRegisteredUserMoodle);
      }

      if (isset($registeredUserSearch)) {

        $courseController = new CourseController();

        $courseSearch = $courseController->findByIdCourseMoodle($courseRegisteredUserMoodle['curso']['idcurso']);

        if (isset($courseSearch)) {

          $courseRegisteredUserMoodle['curso']['idrcurso'] = $courseSearch->id;
          $courseRegisteredUserMoodle['iduser'] = $registeredUserSearch->id;


          $courseRegisteredUserController = new CourseRegisteredUserController();

          $courseRegistereduserSearch = $courseRegisteredUserController->findByIdCourseRegisteredUser($courseRegisteredUserMoodle);

          if (!isset($courseRegistereduserSearch)) {
            $courseRegisteredUserController->store($courseRegisteredUserMoodle);
          }
        }
      }
    }

    return 'OK';
  }

  public function syncronizeAppDaily()
  {

    $response = Http::get('http://localhost:8000/api/collection/category/active');

    $categoriesActive = $response->json();

    $array = [];

    foreach ($categoriesActive as $category) {

      $platformController = new PlatformController();

      $categoryController = new CategoryController();

      $platformSearch = $platformController->findByDescription($category['plataforma']['nombre']);

      $categorySearch = $categoryController->findByIdPlatformAndCategoryMoodle($category['idcategory'], $platformSearch->id);

      $array[] = $categorySearch;
    }

    return $array;
  }
}
