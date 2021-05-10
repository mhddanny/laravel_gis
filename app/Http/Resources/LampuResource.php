<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LampuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'kd_lampu'=>$this->kd_lampu,
          'no_lampu'=>$this->no_lampu,
          'kt_lampu'=>$this->kt_lampu,
          'kd_panel'=>$this->kd_lampu,
          'kd_travo'=>$this->kd_travo,
          'kd_jalan'=>$this->kd_jalan,
          'kd_tiang'=>$this->kd_tiang,
          'kd_jaringan'=>$this->kd_jaringan,
          'ket'=>$this->ket,
          'gambar_lampu'=>env('ASSET_URL')."/uploads/".$this->gambar_lampu
        ];
    }
}
