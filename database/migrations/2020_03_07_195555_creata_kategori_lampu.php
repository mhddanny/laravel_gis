<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreataKategoriLampu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_lampu', function (Blueprint $table) {
            $table->bigIncrements('kt_lampu');
            $table->string('nama_lampu',255);
            $table->enum('kt',['Son-T','Led COB','Led Multi']);
            $table->string('daya',255);
            $table->string('gambar_kt_lampu',255);
            $table->string('gbr', 255);
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
        Schema::dropIfExists('kategori_lampu');
    }
}
