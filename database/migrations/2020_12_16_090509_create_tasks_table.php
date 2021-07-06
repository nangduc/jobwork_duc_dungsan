<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tasks', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->foreignId('customer_id')->constrained()->onDelete('cascade');
      $table->foreignId('task_type_id')->constrained()->onDelete('cascade');
      $table->string('name');
      $table->text('description')->nullable();
      $table->date('expected_order_at')->nullable();
      $table->decimal('survey_price', 15, 2)->nullable();
      $table->decimal('insurance_price', 15, 2)->nullable();
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
    Schema::dropIfExists('tasks');
  }
}
