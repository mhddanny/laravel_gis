<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travo', function (Blueprint $table) {
            $table->bigIncrements('kd_travo');
            $table->string('nama_travo',255);
            $table->unsignedBigInteger('kd_jalan');
            $table->string('latitude',255);
            $table->string('longitude',255);
            $table->enum('rayon',['Bintan Centre','Kota']);
            $table->string('gambar_travo',225)->nullable();

            $table->foreign('kd_jalan')->references('kd_jalan')->on('jalan')->onDelete('cascade');
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
        Schema::dropIfExists('travo');
    }
}
