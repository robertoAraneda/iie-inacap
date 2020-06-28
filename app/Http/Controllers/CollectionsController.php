<?php

namespace App\Http\Controllers;

use App\Actividades as AppActividades;
use App\Category;
use App\Cursos;
use App\InscritoActividad;
use App\Inscritos;
use App\Plataforma;
use App\ReplaceChar;
use Illuminate\Support\Str;

class CollectionsController extends Controller
{


  public function categoryCollectionActive()
  {
    $categories = Category::where('active', 1)->with('plataforma')->get();

    foreach ($categories as $category) {
      $category->nombre =  ReplaceChar::replaceVocalUpperCaseString($category->nombre);
      $category->nombre =  ReplaceChar::replaceVocalLowerCaseString($category->nombre);
      $category->nombre =  ReplaceChar::replaceCharacterString($category->nombre);
    }

    return $categories;
  }


  public function courseCollectionActive()
  {

    $activeCategories = $this->categoryCollectionActive();

    $arrayCourseActive = [];

    foreach ($activeCategories as $activeCategory) {

      $activeCourses = Cursos::where('idcategory', $activeCategory->idcategory)->get();

      foreach ($activeCourses as $activeCourse) {

        $activeCourse->nombre = ReplaceChar::replaceVocalUpperCaseString($activeCourse->nombre);
        $activeCourse->nombre = ReplaceChar::replaceVocalLowerCaseString($activeCourse->nombre);
        $activeCourse->nombre = ReplaceChar::replaceCharacterString($activeCourse->nombre);

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

      $activeActivities = AppActividades::where('idrcurso', $activeCourse['idrcurso'])
        ->with('curso')
        ->get();

      foreach ($activeActivities as $activeActivity) {

        $activeActivity->nombre = ReplaceChar::replaceVocalUpperCaseString($activeActivity->nombre);
        $activeActivity->nombre = ReplaceChar::replaceVocalLowerCaseString($activeActivity->nombre);
        $activeActivity->nombre = ReplaceChar::replaceCharacterString($activeActivity->nombre);

        $activeActivity->curso->nombre = ReplaceChar::replaceVocalUpperCaseString($activeActivity->curso->nombre);
        $activeActivity->curso->nombre = ReplaceChar::replaceVocalLowerCaseString($activeActivity->curso->nombre);
        $activeActivity->curso->nombre = ReplaceChar::replaceCharacterString($activeActivity->curso->nombre);

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
      $activeRegisteredUsers = Inscritos::where('idrcurso', $activeCourse['idrcurso'])
        ->with('curso')
        ->get();

      foreach ($activeRegisteredUsers as $activeRegisteredUser) {

        //    $activeRegisteredUser = $activeRegisteredUsers[1];

        $check = $activeRegisteredUser['ultimoacceso'];

        switch ($check) {
          case Str::contains($check, '1 dÃƒÂ­a'):

            $activeRegisteredUser->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->nombre);
            $activeRegisteredUser->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->nombre);
            $activeRegisteredUser->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->nombre);

            $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->ultimoacceso);
            $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->ultimoacceso);
            $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceCharacterString($activeRegisteredUser->ultimoacceso);

            $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->curso->nombre);
            $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->curso->nombre);
            $activeRegisteredUser->curso->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->curso->nombre);

            $arrayActiveRegisteredUsers[] = $activeRegisteredUser;

            break;

          case Str::contains($check, '2 dÃƒÂ­a'):

            $activeRegisteredUser->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->nombre);
            $activeRegisteredUser->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->nombre);
            $activeRegisteredUser->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->nombre);

            $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->ultimoacceso);
            $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->ultimoacceso);
            $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceCharacterString($activeRegisteredUser->ultimoacceso);

            $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->curso->nombre);
            $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->curso->nombre);
            $activeRegisteredUser->curso->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->curso->nombre);

            $arrayActiveRegisteredUsers[] = $activeRegisteredUser;

            break;

          default:

            if (!Str::contains($check, 'dÃƒÂ­a')) {

              if (!Str::contains($check, 'Nunca')) {

                $activeRegisteredUser->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->nombre);
                $activeRegisteredUser->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->nombre);
                $activeRegisteredUser->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->nombre);

                $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->ultimoacceso);
                $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->ultimoacceso);
                $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceCharacterString($activeRegisteredUser->ultimoacceso);

                $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->curso->nombre);
                $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->curso->nombre);
                $activeRegisteredUser->curso->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->curso->nombre);

                $arrayActiveRegisteredUsers[] = $activeRegisteredUser;
              }
              // if ($activeRegisteredUser['curso']['idcurso'] == 9135) {
              // }
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



  /**metodos para obtener todoa la base de datos iie */

  public function registeredUserActiveInit()
  {
    $activeCourses = $this->courseCollectionActive();

    $arrayActiveRegisteredUsers = [];

    foreach ($activeCourses as $activeCourse) {
      $activeRegisteredUsers = Inscritos::where('idrcurso', $activeCourse['idrcurso'])
        ->with('curso')
        ->get();

      foreach ($activeRegisteredUsers as $activeRegisteredUser) {

        $activeRegisteredUser->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->nombre);
        $activeRegisteredUser->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->nombre);
        $activeRegisteredUser->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->nombre);

        $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->curso->nombre);
        $activeRegisteredUser->curso->nombre = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->curso->nombre);
        $activeRegisteredUser->curso->nombre = ReplaceChar::replaceCharacterString($activeRegisteredUser->curso->nombre);

        $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalUpperCaseString($activeRegisteredUser->ultimoacceso);
        $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceVocalLowerCaseString($activeRegisteredUser->ultimoacceso);
        $activeRegisteredUser->ultimoacceso = ReplaceChar::replaceCharacterString($activeRegisteredUser->ultimoacceso);

        $arrayActiveRegisteredUsers[] = $activeRegisteredUser;
      }
    }

    return $arrayActiveRegisteredUsers;
  }


  public function activityCourseRegisteredUserActiveInit()
  {

    $courseRegisteredUsers = $this->registeredUserActiveInit();

    $arrayActiveActivities = [];

    foreach ($courseRegisteredUsers as $courseRegisteredUser) {

      $arrayActiveActivities[] = InscritoActividad::where('idinscrito', $courseRegisteredUser['idinscrito'])->with('userRegistered.curso', 'activity')->get();
    }

    return $arrayActiveActivities;
  }





  /** metodos que podrían servir */

  public function registeredUserActivity()
  {

    $registeredUserActivity = InscritoActividad::with('userRegistered.curso', 'activity')->paginate(10000);

    return $registeredUserActivity;
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

  public function findUsersByCourse($idMoodleCourse)
  {
    $course = Cursos::where('idcurso', $idMoodleCourse)->first();

    return $course;

    if (isset($course)) {
      $users = Inscritos::where('idrcurso', $course->id)->get();

      return response()->json($users, 200);
    } else {
      return response()->json(null, 204);
    }
  }
}
