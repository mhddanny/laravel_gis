<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaker1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maker1', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('id_pel')->nullable();
          $table->string('nama_jalan');
          $table->string('st_panel');
          $table->string('lat');
          $table->string('long');
          $table->string('no_travo')->nullable();
          $table->string('jaringan')->nullable();
          $table->string('tiang')->nullable();
          $table->string('kategori')->nullable();
          $table->string('daya')->nullable();
          $table->string('rayon')->nullable();
          $table->string('rt_rw')->nullable();
          $table->string('kel')->nullable();
          $table->string('kec')->nullable();
          $table->string('ket')->nullable();
          $table->string('photo')->nullable();
          $table->string('marker')->nullable();
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
        Schema::dropIfExists('maker1');
    }
}
