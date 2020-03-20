<?php

namespace App\Http\Resources;

use App\ReplaceChar;
use Illuminate\Http\Resources\Json\JsonResource;


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
      'idcategory' => $this->idcategory,
      'idplataforma' => $this->idplataforma,
      'timeultimocceso' => $this->timeultimocceso,
      'links' => [
        'href' => 'http://localhost:8000/api/cursos/' . $this->idrcurso,
        'type' => 'GET'
      ]
    ];
  }
}
