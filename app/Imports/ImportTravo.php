<?php

namespace App\Imports;

use App\Travo;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportTravo implements ToCollection
{
    public function collection(Collection $collection)
    {

      foreach ($collection as $key => $row) {
        if ($key >= 1) {
           Travo::create([
            'nama_travo'  => $row[1],
            'kd_jalan'    => $row[2],
            'latitude'    => $row[3],
            'longitude'   => $row[4],
            'rayon'       => $row[5],
          ]);
        }
      }
    }
}
