<?php

namespace App\Http\Controllers;

use App\Cursos;
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
    $courses = Cursos::orderBy('idrcurso')->get();

    $courses = ReplaceChar::replaceStrangeCharacter($courses);

    // $courses->map(function ($course) {
    //   $course['links'] = ['url' => 'http://127.0.0.1:8000/api/cursos/' . $course->idrcurso];

    //   return $course;
    // });

    return response()->json(['data' => $courses], 200);
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
    $course = Cursos::find($id)->get();

    return response()->json(['data' => $course], 200);
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
