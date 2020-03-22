<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\Cursos;
use App\Http\Resources\Actividades as ResourceActividades;
use App\ReplaceChar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ActividadesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return (ResourceActividades::collection(Actividades::paginate()))->response();
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
    $activity = Actividades::where('idactividad', $id)->first();

    $cursoController = new CursosController();

    if (isset($activity)) {
      $activity->nombre = ReplaceChar::replaceStrangeCharacterString($activity->nombre);

      $activity->idrcurso = $cursoController->apiShow($activity->idrcurso);

      //   ReplaceChar::replaceStrangeCharacterArray($activity->usersRegistered);

      return response()->json([
        'data' => $activity,
        'links' => [
          'href' => URL::to('/api/actividades/' . $id),
          'type' => 'GET'
        ]
      ], 200);
    } else {
      return response()->json([
        'data' => null,
        'error' => 'Recurso no encontrado'
      ], 404);
    }
  }

  public function apiShow($id)
  {
    $activity = Actividades::where('idactividad', $id)->with('curso')->first();

    $activity->nombre = ReplaceChar::replaceStrangeCharacterString($activity->nombre);
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
