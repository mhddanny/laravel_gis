<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiang', function (Blueprint $table) {
            $table->bigIncrements('kd_tiang');
            $table->enum('nm',['PLN','PEMKO']);
            $table->enum('jns',['Besi','Beton']);
            $table->enum('knt',['Single Arm','Double Arm','Threth Arm','Forth Arm','Lurus']);
            $table->string('panjang',255);
            $table->string('diameter',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tiang');
    }
}
