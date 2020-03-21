<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Category as CategoryResource;
use App\ReplaceChar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return (CategoryResource::collection(Category::paginate()))->response();
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
    $category = Category::where('idcategory', $id)->with('plataforma', 'courses.activities')->first();

    $category->nombre = ReplaceChar::replaceStrangeCharacterString($category->nombre);

    $courses = ReplaceChar::replaceStrangeCharacterArray($category->courses);

    foreach ($courses as $curso) {

      $curso->activities = ReplaceChar::replaceStrangeCharacterArray($curso->activities);
    }

    return response()->json([
      'data' => $category,
      'links' => [
        'href' => URL::to('/category/' . $id),
        'type' => 'GET'
      ]
    ], 200);
  }

  public function apiShow($id)
  {
    $category = Category::where('idcategory', $id)->with('plataforma')->first();

    $category->nombre = ReplaceChar::replaceStrangeCharacterString($category->nombre);

    return $category;
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
