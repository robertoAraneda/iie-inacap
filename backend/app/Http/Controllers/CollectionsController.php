<?php

namespace App\Http\Controllers;

use App\Actividades as AppActividades;
use App\Cursos;
use App\Http\Resources\Actividades;
use App\Inscritos;
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

  public function activitiesCollection()
  {
    $activities = AppActividades::all();

    foreach ($activities as $activity) {

      $activity->nombre = ReplaceChar::replaceStrangeCharacterString($activity->nombre);
      $activity->curso->nombre = ReplaceChar::replaceStrangeCharacterString($activity->curso->nombre);
    }
    return response()->json($activities, 200);
  }

  public function registeredUsersCollection()
  {

    $registeredUsers = Inscritos::paginate(10);

    foreach ($registeredUsers as $registeredUser) {
      $registeredUser->ultimoacceso = ReplaceChar::replaceStrangeCharacterString($registeredUser->ultimoacceso);

      $registeredUser->nombre = ReplaceChar::replaceStrangeCharacterString($registeredUser->nombre);

      $registeredUser->curso->nombre = ReplaceChar::replaceStrangeCharacterString($registeredUser->curso->nombre);
    }

    return response()->json($registeredUsers, 200);
  }
}
