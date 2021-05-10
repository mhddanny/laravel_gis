<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KategorilampuResource extends JsonResource
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
          'kt_lampu'=>$this->kt_lampu,
          'nama_lampu'=>$this->nama_lampu,
          'kt'=>$this->kt,
          'daya'=>$this->daya,
          'gambar_kt_lampu'=>env('ASSET_URL')."/uploads/".$this->gambar_kt_lampu,
          'gbr'=>env('ASSET_URL')."/uploads/".$this->gbr
        ];
    }
}
