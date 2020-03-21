<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscritoactividadTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('inscritoactividad', function (Blueprint $table) {
      $table->bigIncrements('idinscritoactividad');
      $table->unsignedBigInteger('idinscrito');
      $table->unsignedBigInteger('idacividad');
      $table->string('estado', 50)->nullable();
      $table->string('calificacion', 50)->nullable();
      $table->string('timemodified', 50)->nullable();
      $table->string('ultact', 50)->nullable();
      $table->string('finalizado', 150);
      $table->timestamp('ultimarevisionlohg')->nullable();
      $table->timestamp('timeestado')->nullable();
      $table->timestamp('timefinalizado')->nullable();
      $table->timestamp('timecalificacion')->nullable();
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
    Schema::dropIfExists('inscritoactividad');
  }
}
