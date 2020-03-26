<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'category';

  protected $primaryKey = 'idcategory';

  public $preserveKeys = true;

  public $incrementing = false;

  //relación de 1 category a 1 plataforma (1 es a 1)
  public function plataforma()
  {
    return $this->belongsTo(Plataforma::class, 'idplataforma');
  }

  //relación de 1 category con muchos cursos (1 es a muchos)
  public function courses()
  {
    return $this->hasMany(Cursos::class, 'idcategory', 'idcategory');
  }
}
