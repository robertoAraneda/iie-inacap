<?php

namespace App\Http\Controllers;

use App\Inscritos;
use App\Http\Resources\Inscritos as ResourceInscritos;
use App\ReplaceChar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class InscritosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return (ResourceInscritos::collection(Inscritos::paginate()))->response();
    //
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
    $registered = Inscritos::where('idinscrito', $id)->first();

    $registered->ultimoacceso = ReplaceChar::replaceStrangeCharacterString($registered->ultimoacceso);

    $registered->nombre = ReplaceChar::replaceStrangeCharacterString($registered->nombre);

    return response()->json([
      'data' => $registered,
      'links' => [
        'href' => URL::to('/inscritos/' . $id),
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
