<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
  protected $table = 'cursos';

  protected $primaryKey = 'idrcurso';

  public $preserveKeys = true;

  public $incrementing = false;

  public function category()
  {
    return $this->belongsTo(Category::class, 'idcategory');
  }

  //se hace la relación de 1 curso pertenece a una plataforma
  public function plataforma()
  {
    return $this->belongsTo(Plataforma::class, 'idplataforma');
  }

  //se hace la relación de 1 curso con muchas actividades (1 es a muchos)
  public function activities()
  {
    return $this->hasMany(Actividades::class, 'idrcurso', 'idrcurso');
  }
}
