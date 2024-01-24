<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('accounts_of_user', function (Blueprint $table) {

            $table->increments('id');

            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('accounts_of_user');
    }
}
