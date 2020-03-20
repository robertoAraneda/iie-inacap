<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlataformasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('plataforma', function (Blueprint $table) {

      $table->bigIncrements('idplataforma');
      $table->string('nombre', 50);
      $table->string('http', 5)->default('1');
      $table->string('url', 255);
      $table->string('usr', 40);
      $table->string('pass', 40);
      $table->string('connectMoodle', 45)->default('connectMoodle.php');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('plataforma');
  }
}
