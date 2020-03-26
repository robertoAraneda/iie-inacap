<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscritosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('inscritos', function (Blueprint $table) {
      $table->bigIncrements('idinscrito');
      $table->unsignedBigInteger('iduser');
      $table->unsignedBigInteger('idrcurso');
      $table->unsignedBigInteger('idperfil');
      $table->string('perfil', 20)->nullable();
      $table->text('notas')->nullable();
      $table->string('ultimoacceso', 50)->nullable();
      $table->string('nombre', 191)->nullable();
      $table->string('rut', 20)->nullable();
      $table->string('email', 100)->nullable();
      $table->string('emailnotificacion', 100);
      $table->char('activo', 1)->default('1');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('inscritos');
  }
}
