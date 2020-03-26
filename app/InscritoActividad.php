<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscritoActividad extends Model
{
  protected $table = 'inscritoactividad';

  protected $primaryKey = 'idinscritoactividad';

  public $preserveKeys = true;

  public $incrementing = false;

  //relación 1 registro de este modelo a un inscrito (1 es a 1)
  public function userRegistered()
  {
    return $this->belongsTo(Inscritos::class, 'idinscrito');
  }

  //relación 1 registro de este modelo a una actividad (1 es a uno)
  public function activity()
  {
    return $this->belongsTo(Actividades::class, 'idacividad');
  }
}
