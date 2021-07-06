<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('department_id');
      $table->string('name', 100);
      $table->string('kana_name', 100)->nullable();
      $table->string('username', 100)->unique();
      $table->string('email', 100)->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password', 100);
      $table->string('phone', 50)->unique()->nullable();
      $table->date('birthday')->nullable();
      $table->string('job_title', 100)->nullable();
      $table->string('avatar', 100)->nullable();
      $table->boolean('active')->default(true);
      $table->rememberToken();
      $table->bigInteger('created_by')->unsigned()->nullable();
      $table->bigInteger('updated_by')->unsigned()->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
