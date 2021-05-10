<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori_Lampu extends Model
{
    Protected $table = 'kategori_lampu';
    Protected $primaryKey = 'kt_lampu';
    Protected $fillable = [
      'nama_lampu',
      'kt',
      'daya',
      'gambar_kt_lampu',
      'gbr'
    ];
}
