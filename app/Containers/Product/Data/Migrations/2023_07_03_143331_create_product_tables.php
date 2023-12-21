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

      $table->string('name')->unique()->nullable();
      $table->string('description')->nullable();
      $table->string('image')->nullable();

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
