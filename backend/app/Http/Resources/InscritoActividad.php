<?php

namespace App\Http\Resources;

use App\ReplaceChar;
use Illuminate\Http\Resources\Json\JsonResource;

class InscritoActividad extends JsonResource
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    //return parent::toArray($request);

    return [
      'idinscritoactividad' => $this->idinscritoactividad,
      'idinscrito' => $this->idinscrito,
      'idacividad' => $this->idacividad,
      'estado' => ReplaceChar::replaceStrangeCharacterString($this->estado),
      'calificacion' => ReplaceChar::replaceStrangeCharacterString($this->calificacion),
      'timemodified' => ReplaceChar::replaceStrangeCharacterString($this->timemodified),
      'ultact' => $this->ultact,
      'finalizado' => ReplaceChar::replaceStrangeCharacterString($this->finalizado),
      'ultimarevisionlohg' => $this->ultimarevisionlohg,
      'timeestado' => $this->timeestado,
      'timefinalizado' => $this->timefinalizado,
      'timecalificacion' => $this->timecalificacion,
      'timeultimocceso' => $this->timeultimocceso,

      'links' => [
        'href' => 'http://localhost:8000/api/inscrito-actividad/' . $this->idinscritoactividad,
        'type' => 'GET'

      ]
    ];
  }
}
