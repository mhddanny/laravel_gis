<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jaringan extends Model
{
    protected $table = 'jaringan';
    protected $primaryKey = 'kd_jaringan';
    protected $fillable = [
      'jns',
      'nama_jaringan',
      'jr',
      'luas_penapang',
      'gambar_jaringan',
    ];
}
