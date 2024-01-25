<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVesselsImagesTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('vessel_images', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->integer('vessel_id')->unsigned();
            $table->foreign('vessel_id')->references('id')->on('vessels')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vessel_images');
    }
}
