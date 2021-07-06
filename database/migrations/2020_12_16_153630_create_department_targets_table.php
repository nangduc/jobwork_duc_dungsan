<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentTargetsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('department_targets', function (Blueprint $table) {
      $table->id();
      $table->foreignId('department_id')->constrained()->onDelete('cascade');
      $table->decimal('targets', 15, 2);
      $table->decimal('achievement', 15, 2)->nullable();
      $table->date('from');
      $table->date('to');
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
    Schema::dropIfExists('department_targets');
  }
}
