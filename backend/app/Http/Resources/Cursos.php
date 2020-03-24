<?php

namespace App\Http\Resources;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlataformaController;
use App\ReplaceChar;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Cursos extends JsonResource
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

    return [
      'idrcurso' => $this->idrcurso,
      'activo' => $this->activo,
      'nombre' => ReplaceChar::replaceStrangeCharacterString($this->nombre),
      'idcurso' => $this->idcurso,
      'idcategory' => $this->category,
      'idplataforma' => $this->plataforma,
      'timeultimocceso' => $this->timeultimocceso,
      //'activities' => Actividades::collection($this->activities),
      // 'usersregistered' => Inscritos::collection($this->usersRegistered),
      'links' => [
        'href' => URL::to('/api/cursos/' . $this->idrcurso),
        'type' => 'GET'
      ]
    ];
  }
}
