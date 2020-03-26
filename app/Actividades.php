<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
  protected $table = 'actividades';

  protected $primaryKey = 'idactividad';

  public $preserveKey = true;

  public $incrementing = false;


  //relación de 1 actividad es a 1 curso (1 es a 1)
  public function curso()
  {
    return $this->belongsTo(Cursos::class, 'idrcurso');
  }

  //relación de una actividad pertenece a muchos inscritos (muchos es a muchos)
  public function usersRegistered()
  {

    return $this->belongsToMany(Inscritos::class, 'InscritoActividad', 'idacividad', 'idinscrito')->withPivot(
      'estado',
      'calificacion',
      'timemodified',
      'ultact',
      'finalizado',
      'ultimarevisionlohg',
      'timeestado',
      'timefinalizado',
      'timecalificacion',
      'timeultimocceso'
    );
  }
}
