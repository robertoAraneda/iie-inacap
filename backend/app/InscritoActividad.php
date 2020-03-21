<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscritoActividad extends Model
{
  protected $table = 'inscritoactividad';

  protected $primaryKey = 'idinscritoactividad';

  public $preserveKeys = true;

  public $incrementing = false;
}
