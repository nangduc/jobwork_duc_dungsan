<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskProgressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('task_progresses', function (Blueprint $table) {
      $table->id();
      $table->date('date');
      $table->foreignId('task_id')->constrained()->onDelete('cascade');
      $table->foreignId('sale_status_id')->nullable()->constrained()->onDelete('cascade');
      $table->foreignId('negotiation_status_id')->nullable()->constrained()->onDelete('cascade');
      $table->foreignId('negotiation_result_status_id')->nullable()->constrained()->onDelete('cascade');
      $table->foreignId('accuracy_id')->nullable()->constrained()->onDelete('cascade');
      $table->foreignId('companion_id')->nullable()->constrained()->onDelete('cascade');
      $table->text('description')->nullable();
      $table->date('next_negotiation_date')->nullable();
      $table->string('plan_next_time')->nullable();
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
    Schema::dropIfExists('task_progresses');
  }
}
