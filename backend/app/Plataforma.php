<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
  protected $table = 'plataforma';

  protected $primaryKey = 'idplataforma';

  public $preserveKey = true;

  public $incrementing = false;

  public function categories()
  {
    return $this->hasMany(Category::class, 'idplataforma', 'idplataforma');
  }
}