<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cursos', function (Blueprint $table) {
      $table->bigIncrements('idrcurso');
      $table->char('activo', 1)->default('1');
      $table->unsignedBigInteger('idcurso');
      $table->string('nombre', 191);
      $table->unsignedBigInteger('idcategory');
      $table->unsignedBigInteger('idplataforma');
      $table->timestamp('timeultimocceso')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('cursos');
  }
}
