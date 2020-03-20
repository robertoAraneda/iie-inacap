<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
  protected $table = 'cursos';

  protected $primaryKey = 'idrcurso';

  public $preserveKeys = true;

  public $incrementing = false;
}
