<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\Http\Resources\Cursos as ResourceCursos;
use App\ReplaceChar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CursosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return (ResourceCursos::collection(Cursos::all()))->response();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $course = Cursos::where('idrcurso', $id)->with('plataforma')->first();

    ReplaceChar::replaceStrangeCharacterString($course->nombre);

    ReplaceChar::replaceStrangeCharacterString($course->category->nombre);

    ReplaceChar::replaceStrangeCharacterArray($course->usersRegistered);

    ReplaceChar::replaceStrangeCharacterArray($course->activities);

    return response()->json([
      'data' => $course,
      'links' => [
        'href' => URL::to('/api/cursos/' . $id),
        'type' => 'GET'
      ]
    ], 200);
  }

  public function apiShow($id)
  {
    $course = Cursos::where('idrcurso', $id)->with('category', 'plataforma')->first();

    $course->nombre = ReplaceChar::replaceStrangeCharacterString($course->nombre);

    //ReplaceChar::replaceStrangeCharacterArray($course->activities);

    return $course;
  }



  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
