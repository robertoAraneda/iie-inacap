<?php

namespace App\Http\Controllers;

use App\InscritoActividad;
use App\Http\Resources\InscritoActividad as ResourceInscritoActividad;
use App\ReplaceChar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class InscritoActividadController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return (ResourceInscritoActividad::collection(InscritoActividad::paginate()))->response();
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
    $registeredActivity = InscritoActividad::where('idinscritoactividad', $id)->first();

    $registeredActivity->estado = ReplaceChar::replaceStrangeCharacterString($registeredActivity->estado);

    $registeredActivity->calificacion = ReplaceChar::replaceStrangeCharacterString($registeredActivity->calificacion);

    $registeredActivity->timemodified = ReplaceChar::replaceStrangeCharacterString($registeredActivity->timemodified);

    $registeredActivity->ultact = ReplaceChar::replaceStrangeCharacterString($registeredActivity->finalizado);

    return response()->json([
      'data' => $registeredActivity,
      'links' => [
        'href' => URL::to('/inscritoactividad/' . $id),
        'type' => 'GET'
      ]
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
