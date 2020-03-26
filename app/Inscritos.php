<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscritos extends Model
{
  protected $table = 'inscritos';

  protected $primaryKey = 'idinscrito';

  public $preserveKeys = true;

  public $incrementing = false;

  //relación de 1 inscrito a 1 curso (1 es a 1)
  public function curso()
  {
    return $this->belongsTo(Cursos::class, 'idrcurso');
  }

  //relación de 1 inscrito pertenece a muchas actividades (muchos es a muchos)
  public function activities()
  {
    return $this->belongsToMany(Actividades::class, 'inscritoactividad'
    /**nombre de la tabla relacional */
    , 'idinscrito'
    /** nombre de la columna 1 */
    , 'idacividad'
      /**nombre de la columma 2 */
    );
  }
}
