<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TravoResource extends JsonResource
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
          'kd_travo'=>$this->kd_travo,
          'nama_travo'=>$this->nama_travo,
          'kd_jalan'=>$this->kd_jalan,
          'latitude'=>$this->latitude,
          'longitude'=>$this->longitude,
          'rayon'=>$this->rayon,
          'gambar_travo'=>env('ASSET_URL')."/uploads/".$this->gambar_travo

        ];
    }
}
