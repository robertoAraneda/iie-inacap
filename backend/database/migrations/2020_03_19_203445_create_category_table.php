<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('category', function (Blueprint $table) {
      $table->bigIncrements('idcategory');
      $table->unsignedBigInteger('idplataforma');
      $table->string('nombre', 255)->nullable();
      $table->char('active', 1)->default('1');
      $table->char('downloadlogs', 1)->default('0');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('category');
  }
}
