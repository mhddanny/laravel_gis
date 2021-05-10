<?php

namespace App\Imports;

use App\Jalan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportJalan implements ToCollection
{
  /**
   * @param array $row
   *
   * @return Jalan|null
   */

    public function collection(Collection $collection)
    {
       // dd($collection);
      foreach ($collection as $key => $row) {
        if ($key >= 1) {
          // code...
          Jalan::create([
            'nama_jalan'  => $row[1],
            'kec'         => $row[2],
            'kel'         => $row[3],
            'rt_rw'       => $row[4],
          ]);
        }

      }
    }
}
