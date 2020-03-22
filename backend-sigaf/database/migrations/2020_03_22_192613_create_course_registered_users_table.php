<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseRegisteredUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('course_registered_users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->unsignedBigInteger('course_id');
      $table->unsignedBigInteger('registered_user_id');
      $table->unsignedBigInteger('profile_id');
      $table->unsignedBigInteger('classroom_id');
      $table->unsignedBigInteger('final_status_id');
      $table->unsignedInteger('final_qualification');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('course_registered_users');
  }
}
