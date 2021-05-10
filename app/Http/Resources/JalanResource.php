<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JalanResource extends JsonResource
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
          'kd_jalan'=>$this->kd_jalan,
          'nama_jalan'=>$this->nama_jalan,
          'start'=>$this->start,
          'finis'=>$this->finis,
          'kel'=>$this->kel,
          'kec'=>$this->kec
        ];
    }
}
