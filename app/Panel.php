<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    protected $table = 'panel';
    protected $primaryKey = 'kd_panel';
    protected $fillable = [
      'no_panel',
      'kd_jalan',
      'kd_travo',
      'id_pel',
      'kt_panel',
      'daya_kwh',
      'latitude',
      'longitude',
      'gambar_panel',
      'ket'
    ];

    public function jalan()
    {
      return $this->belongsTo('App\Jalan','kd_jalan');
    }

    public function travo()
    {
      return $this->belongsTo('App\Travo','kd_travo');
    }

    public function lampu(){
      return $this->hasMany('App\Lampu','kd_lampu');
    }

}
