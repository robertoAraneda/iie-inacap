<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('actividades', function (Blueprint $table) {
      $table->bigIncrements('idactividad');
      $table->unsignedBigInteger('idmod');
      $table->unsignedBigInteger('idrcurso');
      $table->string('nombre', 191)->nullable();
      $table->string('tipo', 50)->nullable();
      $table->timestamp('lastact')->nullable();
      $table->char('revisar', 1)->default('1');
      $table->timestamp('finish')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('actividades');
  }
}
