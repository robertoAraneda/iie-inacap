<?php

namespace App\Http\Resources;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CursosController;
use App\ReplaceChar;
use Illuminate\Http\Resources\Json\JsonResource;

class Actividades extends JsonResource
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    // return parent::toArray($request);

    $courseController = new CursosController();

    return [
      'idactividad' => $this->idactividad,
      'idmod' => $this->idmod,
      'idrcurso' => $courseController->apiShow($this->idrcurso),
      'nombre' => ReplaceChar::replaceStrangeCharacterString($this->nombre),
      'tipo' => $this->tipo,
      'lastact' => $this->lastact,
      'revisar' => $this->revisar,
      'finish' => $this->finish,

      'links' => [
        'href' => 'http://localhost:8000/api/actividades/' . $this->idactividad,
        'type' => 'GET'
      ]
    ];
  }
}
