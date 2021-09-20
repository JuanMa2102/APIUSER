<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('direction');
            $table->integer('cp');
            $table->string('contact');
            $table->string('phone');
            $table->string('email');
            $table->string('rfc');
            $table->unsignedBigInteger('id_aplication');
            $table->timestamps();
            $table->foreign('id_aplication')->references('id')->on('aplications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
