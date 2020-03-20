<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscritos extends Model
{
  protected $table = 'inscritos';

  protected $primaryKey = 'idinscrito';

  public $preserveKeys = true;

  public $incrementing = false;
}
