<?php

namespace App\Http\Resources;

use App\Http\Controllers\PlataformaController;
use App\ReplaceChar;
use App\Http\Resources\Cursos as ResourceCursos;
use App\Plataforma;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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

    $plataformaController = new PlataformaController();

    return [
      'idcategory' => $this->idcategory,
      'idplataforma' => Plataforma::where('idplataforma', $this->idplataforma)->first(),
      'nombre' => ReplaceChar::replaceStrangeCharacterString($this->nombre),
      'active' => $this->active,
      'downloadlogs' => $this->downloadlogs,
      'courses' => ResourceCursos::collection($this->courses),
      'links' => [
        'href' => 'http://localhost:8000/api/category/' . $this->idcategory,
        'type' => 'GET'
      ]
    ];
  }
}
