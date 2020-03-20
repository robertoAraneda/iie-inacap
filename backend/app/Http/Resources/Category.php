<?php

namespace App\Http\Resources;

use App\ReplaceChar;
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

    return [
      'idcategory' => $this->idcategory,
      'idplataforma' => $this->idplataforma,
      'nombre' => ReplaceChar::replaceStrangeCharacterString($this->nombre),
      'active' => $this->active,
      'downloadlogs' => $this->downloadlogs,
      'links' => [
        'href' => 'http://localhost:8000/api/category/' . $this->idcategory,
        'type' => 'GET'
      ]
    ];
  }
}
