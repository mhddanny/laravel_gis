<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jalan extends Model
{
      protected $table = 'jalan';
      protected $primaryKey = 'kd_jalan';
      protected $fillable = [
        'nama_jalan',
        'kel',
        'kec',
        'rt_rw'
      ];
}
