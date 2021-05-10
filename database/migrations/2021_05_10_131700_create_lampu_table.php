<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLampuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lampu', function (Blueprint $table) {
            $table->bigIncrements('kd_lampu');
            $table->string('no_lampu',255);
            $table->unsignedBigInteger('kt_lampu');
            $table->unsignedBigInteger('kd_panel');
            $table->unsignedBigInteger('kd_travo');
            $table->unsignedBigInteger('kd_jalan');
            $table->unsignedBigInteger('kd_tiang');
            $table->unsignedBigInteger('kd_jaringan');
            $table->string('latitude',255);
            $table->string('longitude',255);
            $table->enum('ket',['Hidup','Mati']);
            $table->string('gambar_lampu',255)->nullable();

            $table->foreign('kt_lampu')->references('kt_lampu')->on('kategori_lampu')->onDelete('cascade');
            $table->foreign('kd_panel')->references('kd_panel')->on('panel')->onDelete('cascade');
            $table->foreign('kd_travo')->references('kd_travo')->on('travo')->onDelete('cascade');
            $table->foreign('kd_jalan')->references('kd_jalan')->on('jalan')->onDelete('cascade');
            $table->foreign('kd_tiang')->references('kd_tiang')->on('tiang')->onDelete('cascade');
            $table->foreign('kd_jaringan')->references('kd_jaringan')->on('jaringan')->onDelete('cascade');
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
        Schema::dropIfExists('lampu');
    }
}
