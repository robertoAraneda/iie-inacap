<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Plataforma extends JsonResource
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
      'idplataforma' => $this->idplataforma,
      'nombre' => $this->nombre,
      'http' => $this->http,
      'url' => $this->url,
      'usr' => $this->usr,
      'pass' => $this->pass,
      'connectMoodle' => $this->connectMoodle,
      'categories' => Category::collection($this->categories),

      'links' => [
        'href' => URL::to('/api/plataforma/' . $this->idplataforma),
        'type' => 'GET'
      ]
    ];
  }
}
