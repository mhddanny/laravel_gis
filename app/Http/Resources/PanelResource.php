<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PanelResource extends JsonResource
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
            'kd_panel'=>$this->kd_panel,
            'no_panel'=>$this->no_panel,
            'kd_jalan'=>$this->kd_jalan,
            'kd_travo'=>$this->kd_travo,
            'id_pel'=>$this->id_pel,
            'daya_kwh'=>$this->daya_kwh,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'gambar_panel'=>env('ASSET_URL')."/uploads/".$this->gambar_panel,
            'ket'=>$this->ket
        ];
    }
}
