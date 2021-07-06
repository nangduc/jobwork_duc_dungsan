<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
      $table->id();
      // $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->unsignedBigInteger('parent_id')->nullable();
      $table->string('name', 100);
      $table->string('kana_name', 100)->nullable();
      $table->string('business_name')->nullable();
      $table->string('short_name', 100)->nullable();
      $table->string('representative', 100)->nullable();
      $table->string('image', 100)->nullable();
      $table->string('building_name', 100)->nullable();
      $table->string('street', 100)->nullable();
      $table->string('district', 100)->nullable();
      $table->string('province', 100)->nullable();
      $table->string('address')->nullable();
      $table->string('post_code', 100)->nullable();
      $table->string('phone', 100)->nullable();
      $table->string('fax', 100)->nullable();
      $table->string('email', 100)->nullable();
      $table->string('website', 100)->nullable();
      $table->decimal('charter_capital', 15, 2)->nullable();
      $table->date('founding')->nullable();
      $table->integer('number_of_employees')->unsigned()->nullable();
      $table->decimal('revenue', 15, 2)->nullable();
      $table->text('remark')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    Schema::create('customer_field', function (Blueprint $table) {
      $table->id();
      // $table->unsignedInteger('customer_id');
      // $table->unsignedInteger('field_id');
      $table->foreignId('field_id')->constrained()->onDelete('cascade');
      $table->foreignId('customer_id')->constrained()->onDelete('cascade');;
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('customer_field');
    Schema::dropIfExists('customers');
  }
}
