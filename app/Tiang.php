<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiang extends Model
{
      protected $table = 'tiang';
      protected $primaryKey = 'kd_tiang';
      protected $fillable = [
        'nm',
        'jns',
        'knt',
        'panjang',
        'diameter'
      ];
}
