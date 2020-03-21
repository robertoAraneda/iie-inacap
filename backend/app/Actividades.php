<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
  protected $table = 'actividades';

  protected $primaryKey = 'idactividad';

  public $preserveKey = true;

  public $incrementing = false;

  //se hace la relación de 1 actividad pertenece a 1 curso (singular)
  public function curso()
  {
    return $this->belongsTo(Cursos::class, 'idrcurso');
  }
}
