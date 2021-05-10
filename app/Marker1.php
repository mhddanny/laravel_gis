<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker1 extends Model
{
    protected $table = 'maker1' ;
    protected $primaryKey = 'id';
    protected $fillable = [
      'id_pel',
      'nama_jalan',
      'st_panel',
      'lat',
      'long',
      'no_travo',
      'jaringan',
      'tiang',
      'kategori',
      'daya',
      'rayon',
      'rt_rw',
      'kel',
      'kec',
      'ket',
      'photo',
      'marker',
    ];

}
