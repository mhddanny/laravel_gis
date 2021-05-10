<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Marker1Resource extends JsonResource
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
          'latitude'=>$this->latitude,
          'longitude'=>$this->longitude

        ];
    }
}
