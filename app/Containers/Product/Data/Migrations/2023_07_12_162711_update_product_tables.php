<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProductTables extends Migration
{

  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::table('products', function (Blueprint $table) {

      $table->string('name', 255)->change();
      $table->string('description', 4096)->nullable()->change();
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