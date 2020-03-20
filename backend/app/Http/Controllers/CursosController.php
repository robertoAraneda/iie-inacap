<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\Http\Resources\Cursos as ResourceCursos;
use App\ReplaceChar;
use Illuminate\Http\Request;

class CursosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return (ResourceCursos::collection(Cursos::paginate()))->response();
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
    $course = Cursos::where('idrcurso', $id)->first();

    $course->nombre = ReplaceChar::replaceStrangeCharacterString($course->nombre);

    return response()->json([
      'data' => $course,
      'links' => ['href' => 'http://localhost:8000/api/cursos/' . $id, 'type' => 'GET']
    ], 200);
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
