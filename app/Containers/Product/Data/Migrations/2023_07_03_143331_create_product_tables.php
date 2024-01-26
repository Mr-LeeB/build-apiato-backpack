<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTables extends Migration
{

  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {

      $table->increments('id');

      $table->string('name', 255)->unique()->nullable();
      $table->string('description', 4096)->nullable();
      $table->string('image')->nullable();

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');

      $table->timestamps();
      //$table->softDeletes();

    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
}
