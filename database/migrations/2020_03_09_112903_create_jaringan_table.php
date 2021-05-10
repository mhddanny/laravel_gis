<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJaringanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jaringan', function (Blueprint $table) {
            $table->bigIncrements('kd_jaringan');
            $table->enum('jns',['Pemko','PLN']);
            $table->string('nama_jaringan',255);
            $table->enum('jr',['Kabel Tanah','Kabel Udara']);
            $table->string('luas_penapang',255);
            $table->string('gambar_jaringan',255);
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
        Schema::dropIfExists('jaringan');
    }
}
