<?php

namespace App\Http\Resources;

use App\ReplaceChar;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Inscritos extends JsonResource
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
      'idinscrito' => $this->idinscrito,
      'iduser' => $this->iduser,
      'idrcurso' => $this->idrcurso,
      'idperfil' => $this->idperfil,
      'perfil' => $this->perfil,
      'notas' => $this->notas,
      'ultimoacceso' => ReplaceChar::replaceStrangeCharacterString($this->ultimoacceso),
      'nombre' => ReplaceChar::replaceStrangeCharacterString($this->nombre),
      'rut' => $this->rut,
      'email' => $this->email,
      'emailnotificacion' => $this->emailnotificacion,
      'activo' => $this->activo,

      'links' => [
        'href' => URL::to('/api/inscritos/' . $this->idinscrito),
        'type' => 'GET'
      ]
    ];
  }
}
