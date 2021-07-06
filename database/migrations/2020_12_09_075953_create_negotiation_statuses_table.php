<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationStatusesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('negotiation_statuses', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('sale_status_id');
      $table->foreign('sale_status_id')->references('id')->on('sale_statuses');
      $table->string('name', 100);
      $table->string('color')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('negotiation_statuses');
  }
}
