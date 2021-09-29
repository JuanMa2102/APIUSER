<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_business_unit');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
            $table->foreign('id_business_unit')->references('id')->on('business_units');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_units');
    }
}
