<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori_panel extends Model
{
    protected $table = 'kategori_panel';
    protected $fillable = [
        'nama_panel',
        'icon_panel',
        'ket'
    ];
}
