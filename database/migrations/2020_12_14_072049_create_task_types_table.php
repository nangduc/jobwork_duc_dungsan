<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTypesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('task_types', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('task_group_id');
      $table->string('name', 100);
      $table->timestamps();
      $table->foreign('task_group_id')->references('id')->on('task_groups')->onDelete('cascade');
    });

    Schema::create('department_task_type', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('department_id');
      $table->unsignedBigInteger('task_type_id');
      $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
      $table->foreign('task_type_id')->references('id')->on('task_types')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('department_task_type');
    Schema::dropIfExists('task_types');
  }
}
