<?php

namespace App\Http\Controllers;

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
    return $array;
  }
}
