<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travo extends Model
{
      protected $table = 'travo';
      protected $primaryKey = 'kd_travo';
      protected $fillable = [
        'nama_travo',
        'kd_jalan',
        'latitude',
        'longitude',
        'rayon',
        'gambar_travo'
      ];

      public function jalan()
      {
        return $this->belongsTo('App\Jalan','kd_jalan');
      }
}
