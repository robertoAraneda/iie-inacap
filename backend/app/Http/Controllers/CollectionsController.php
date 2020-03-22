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
      ->paginate(10);

    return response()->json($courses, 200);
  }

  public function plataformaCollection()
  {
    $platforms = Plataforma::with('categories.courses')->paginate(1);

    return response()->json($platforms, 200);
  }

  public function courseDetail($id)
  {
    $course = Cursos::where('idrcurso', $id)->with('activities.usersRegistered')->first();

    return $course;
  }
}
