<?php

namespace App\Http\Controllers;

use App\Plataforma;
use App\Http\Resources\Plataforma as ResourcePlataforma;
use App\ReplaceChar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PlataformaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return (ResourcePlataforma::collection(Plataforma::paginate()))->response();
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
    $platform = Plataforma::where('idplataforma', $id)->with('categories.courses.activities')->first();

    $categorias = $platform->categories;

    foreach ($categorias as $categoria) {
      $cursos = $categoria->courses;
      ReplaceChar::replaceStrangeCharacterArray($cursos);
      foreach ($cursos as $curso) {
        $actividades = $curso->activities;
        ReplaceChar::replaceStrangeCharacterArray($actividades);
      }
    }

    return response()->json([
      'data' => $platform,
      'links' => [
        'href' => URL::to('/plataforma/' . $id),
        'type' => 'GET'
      ]
    ], 200);
  }

  public function apiShow($id)
  {
    $platform = Plataforma::where('idplataforma', $id)->first();

    return $platform;
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
