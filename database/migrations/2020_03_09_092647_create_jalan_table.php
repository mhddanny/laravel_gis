<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJalanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jalan', function (Blueprint $table) {
            $table->bigIncrements('kd_jalan');
            $table->string('nama_jalan',255);
            $table->enum('kec',['Bukit Bestari','Barat','Kota','Timur']);
            $table->enum('kel',['Dompak','Sei Jang','Tanjung Ayun Sakti','Tanjungpinang Timur','Tanjung Unggat',
                          'Bukit Cermin','Kampung Baru','Kemboja','Tanjungpinang Barat',
                          'Kampung Bugis','Penyengat','Senggarang','Tanjungpinang Kota',
                          'Air Raja','Batu IX','Kampung Bulang','Melayu Kota Piring','Pinang Kencana']);
            $table->string('rt_rw', 255)->nullable();
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
        Schema::dropIfExists('jalan');
    }
}
