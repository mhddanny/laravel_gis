<?php

namespace App\Imports;

use App\Panel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportPanel implements ToCollection
{
    public function collection(Collection $collection)
    {
       // dd($collection);
      foreach ($collection as $key => $row) {
        if ($key >= 1) {
          // code...
          Panel::create([
            'no_panel'      => $row[1],
            'kd_jalan'      => $row[2],
            'kd_travo'      => $row[3],
            'id_pel'        => $row[4],
            'kt_panel'      => $row[5],
            'daya_kwh'      => $row[6],
            'lat'           => $row[7],
            'long'          => $row[8],
            'gambar_panel'  => $row[9],
            'ket'           => $row[10],

          ]);
        }
      }
    }
  }
