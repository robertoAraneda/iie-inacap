<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'category';

  protected $primaryKey = 'idcategory';

  public $preserveKeys = true;

  public $incrementing = false;

  public function plataforma()
  {
    return $this->belongsTo(Plataforma::class, 'idplataforma');
  }

  //una categoria tiene muchos cursos
  public function courses()
  {
    return $this->hasMany(Cursos::class, 'idcategory', 'idcategory');
  }
}
