<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lampu extends Model
{
    protected $table = 'lampu';
    protected $primaryKey = 'kd_lampu';
    protected $fillable = [
      'no_lampu',
      'kt_lampu',
      'kd_panel',
      'kd_travo',
      'kd_jalan',
      'kd_tiang',
      'kd_jaringan',
      'latitude',
      'longitude',
      'ket',
      'gambar_lampu'
    ];

    public function kategori()
    {
      return $this->belongsTo('App\Kategori_Lampu','kt_lampu');
    }

    public function panel()
    {
      return $this->belongsTo('App\Panel','kd_panel');
    }

    public function travo()
    {
      return $this->belongsTo('App\Travo','kd_travo');
    }

    public function jalan()
    {
      return $this->belongsTo('App\Jalan','kd_jalan');
    }

    public function tiang()
    {
      return $this->belongsTo('App\Tiang','kd_tiang');
    }

    public function jaringan()
    {
      return $this->belongsTo('App\Jaringan','kd_jaringan');
    }
}
