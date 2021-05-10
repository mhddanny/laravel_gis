<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel', function (Blueprint $table) {
            $table->bigIncrements('kd_panel');
            $table->string('no_panel',255);
            $table->unsignedBigInteger('kd_jalan');
            $table->unsignedBigInteger('kd_travo');
            $table->enum('kt_panel',['Panel Meteran', 'Panel Non Meteran', 'Tersebar']);
            $table->string('id_pel',255);
            $table->string('daya_kwh');
            $table->string('latitude',255);
            $table->string('longitude',255);
            $table->string('gambar_panel',255);
            $table->string('ket',225);

            $table->foreign('kd_jalan')->references('kd_jalan')->on('jalan')->onDelete('cascade');
            $table->foreign('kd_travo')->references('kd_travo')->on('travo')->onDelete('cascade');
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
        Schema::dropIfExists('panel');
    }
}
