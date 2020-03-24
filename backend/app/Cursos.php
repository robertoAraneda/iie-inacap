<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
  protected $table = 'cursos';

  protected $primaryKey = 'idrcurso';

  public $preserveKeys = true;

  public $incrementing = false;

  //relación de 1 curso a 1 category (1 es a 1)
  public function category()
  {
    return $this->belongsTo(Category::class, 'idcategory');
  }

  //relación de 1 curso pertenece a 1 plataforma (1 es a 1)
  public function plataforma()
  {
    return $this->belongsTo(Plataforma::class, 'idplataforma');
  }

  //relación de 1 curso con muchas actividades (1 es a muchos)
  public function activities()
  {
    return $this->hasMany(Actividades::class, 'idrcurso', 'idrcurso');
  }

  //relación de 1 curso con muchos inscritos ( 1 es a muchos)
  public function usersRegistered()
  {
    return $this->hasMany(Inscritos::class, 'idrcurso', 'idrcurso');
  }
}
