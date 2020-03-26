<?php

namespace App\Http\Controllers;

use App\Actividades as AppActividades;
use App\Category;
use App\Cursos;
use App\Http\Resources\Actividades;
use App\InscritoActividad;
use App\Inscritos;
use App\Plataforma;
use App\ReplaceChar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollectionsController extends Controller
{
  public function cursosCollection()
  {

    $courses = Cursos::orderBy('idrcurso')
      ->with('plataforma')
      ->with('category')
      ->cursor()->filter(function ($curso) {

        $curso->activities;

        $curso->usersRegistered;

        return $curso->category->active == 1;
      });

    return response()->json($courses, 200);
  }

  public function categoryCollectionActive()
  {
    $category = ReplaceChar::replaceStrangeCharacterArray(Category::where('active', 1)->with('plataforma')->get());

    return $category;
  }


  public function courseCollectionActive()
  {

    $activeCategories = $this->categoryCollectionActive();

    $arrayCourseActive = [];

    //return $activeCategories;

    foreach ($activeCategories as $activeCategory) {

      $activeCourses = ReplaceChar::replaceStrangeCharacterArray(Cursos::where('idcategory', $activeCategory->idcategory)->get());

      foreach ($activeCourses as $activeCourse) {
        $arrayCourseActive[] = $activeCourse;
      }
    }

    return $arrayCourseActive;
  }

  public function activitiesCollectionActive()
  {

    $activeCourses = $this->courseCollectionActive();

    $arrayActiveActivities = [];

    foreach ($activeCourses as $activeCourse) {

      $activeActivities = ReplaceChar::replaceStrangeCharacterArray(AppActividades::where('idrcurso', $activeCourse['idrcurso'])
        ->with('curso')
        ->get());

      foreach ($activeActivities as $activeActivity) {
        $arrayActiveActivities[] = $activeActivity;
      }
    }

    return $arrayActiveActivities;
  }


  public function registeredUserActive()
  {
    $activeCourses = $this->courseCollectionActive();

    $arrayActiveRegisteredUsers = [];

    foreach ($activeCourses as $activeCourse) {
      $activeRegisteredUsers = ReplaceChar::replaceStrangeCharacterArray(Inscritos::where('idrcurso', $activeCourse['idrcurso'])
        ->with('curso')
        ->get());

      foreach ($activeRegisteredUsers as $activeRegisteredUser) {

        $check = $activeRegisteredUser['ultimoacceso'];

        if (!Str::containsAll($check, ['dí­as', 'horas'])) {
          if ($activeRegisteredUser['curso']['idcurso'] == 9135) {
            $arrayActiveRegisteredUsers[] = $activeRegisteredUser;
          }
        }
      }
    }

    return $arrayActiveRegisteredUsers;
  }

  public function activityCourseRegisteredUserActive()
  {

    $courseRegisteredUsers = $this->registeredUserActive();

    $arrayActiveActivities = [];

    foreach ($courseRegisteredUsers as $courseRegisteredUser) {

      $arrayActiveActivities[] = InscritoActividad::where('idinscrito', $courseRegisteredUser['idinscrito'])->with('userRegistered.curso', 'activity')->get();
    }

    return $arrayActiveActivities;
  }

  public function activityCourseRegisteredUserActive24()
  {

    $courseRegisteredUsers = $this->registeredUserActive();

    $arrayActiveActivities = [];

    foreach ($courseRegisteredUsers as $courseRegisteredUser) {

      $arrayActiveActivities[] = InscritoActividad::where('idinscrito', $courseRegisteredUser['idinscrito'])->with('userRegistered.curso', 'activity')->get();
    }

    return count($arrayActiveActivities[]);
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

    $registeredUsers = Inscritos::all();

    foreach ($registeredUsers as $registeredUser) {
      $registeredUser->ultimoacceso = ReplaceChar::replaceStrangeCharacterString($registeredUser->ultimoacceso);

      $registeredUser->nombre = ReplaceChar::replaceStrangeCharacterString($registeredUser->nombre);

      $registeredUser->curso->nombre = ReplaceChar::replaceStrangeCharacterString($registeredUser->curso->nombre);
    }

    return response()->json($registeredUsers, 200);
  }

  public function registeredUserActivity()
  {

    $registeredUserActivity = InscritoActividad::with('userRegistered.curso', 'activity')->paginate(10000);

    return $registeredUserActivity;
  }
}
