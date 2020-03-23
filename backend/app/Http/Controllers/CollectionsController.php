<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\Plataforma;
use App\ReplaceChar;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
  public function cursosCollection()
  {

    $courses = Cursos::orderBy('idrcurso')
      ->with('plataforma')
      ->with('category')
      ->get();

    return response()->json($courses, 200);
  }

  public function plataformaCollection()
  {

    $platforms = Plataforma::all()->map(function ($platform) {

      $coursesFormat = [];

      foreach (ReplaceChar::replaceStrangeCharacterArray($platform->categories) as $category) {

        foreach (ReplaceChar::replaceStrangeCharacterArray($category->courses) as $course) {

          if ($category->idplataforma == $course->idplataforma) {

            $coursesFormat[] = $course;
          }
          $category['coursesFormat'] = $coursesFormat;
        }
        $coursesFormat = [];
      }

      return $platform;
    });

    return response()->json($platforms, 200);
  }

  public function courseDetail($id)
  {
    $course = Cursos::where('idrcurso', $id)->with('activities.usersRegistered')->first();

    return $course;
  }
}
