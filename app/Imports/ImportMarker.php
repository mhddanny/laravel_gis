<?php

namespace App\Imports;

use App\Marker1;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportMarker implements ToModel
{
	public function model(array $row)
    {
      return new Marker1([
	        'id_pel' => $row[0],
            'nama_jalan' => $row[1],
            'st_panel' => $row[2],
            'lat' => $row[3],
            'long' => $row[4],
            'no_travo' => $row[5],
            'jaringan' => $row[6],
            'tiang' => $row[7],
            'kategori' => $row[8],
            'daya' => $row[9],
            'rayon' => $row[10],
            'rt_rw' => $row[11],
            'kel' => $row[12],
            'kec' => $row[13],
            'ket' => $row[14],
      ]);
    }
}
