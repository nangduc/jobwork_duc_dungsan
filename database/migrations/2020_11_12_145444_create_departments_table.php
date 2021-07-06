<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('departments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('manager_id')->comment('department manager');
      $table->string('name', 100);
      $table->nestedSet();
      $table->bigInteger('created_by')->unsigned()->nullable();
      $table->bigInteger('updated_by')->unsigned()->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
    Schema::table('users', function ($table) {
      $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    Schema::dropIfExists('departments');
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
  }
}
