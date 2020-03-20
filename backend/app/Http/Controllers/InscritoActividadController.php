<?php

namespace App\Http\Controllers;

use App\InscritoActividad;
use App\ReplaceChar;
use Illuminate\Http\Request;

class InscritoActividadController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $registeredActivities = InscritoActividad::orderBy('idinscritoactividad')->get();

    $registeredActivities = ReplaceChar::replaceStrangeCharacterArray($registeredActivities);

    return response()->json(['data' => $registeredActivities], 200);
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
    $registeredActivity = InscritoActividad::find($id)->get();

    return response()->json(['data' => $registeredActivity], 200);
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
