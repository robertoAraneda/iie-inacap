<?php

namespace App\Http\Resources;

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

    return [
      'idactividad' => $this->idactividad,
      'idmod' => $this->idmod,
      'idrcurso' => $this->idrcurso,
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
