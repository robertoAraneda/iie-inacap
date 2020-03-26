<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
  protected $table = 'plataforma';

  protected $primaryKey = 'idplataforma';

  public $preserveKey = true;

  public $incrementing = false;

  //relación de 1 plataforma con muchas categories (1 es a) 
  public function categories()
  {
    return $this->hasMany(Category::class, 'idplataforma', 'idplataforma');
  }
}
