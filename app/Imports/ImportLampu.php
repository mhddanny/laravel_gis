<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Lampu;

class ImportLampu implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
      // dd($collection);
        foreach ($collection as $key => $row) {
          // untuk memulai index yang kosong
             if ($key >= 1 ) {
              // code...
              // $tanggal = ($row[5] - 25569) * 86400;
              Lampu::create([
                'no_lampu'    => $row[1],
                'kt_lampu'    => $row[2],
                'kd_panel'    => $row[3],
                'kd_travo'    => $row[4],
                'kd_jalan'    => $row[5],
                'kd_tiang'    => $row[6],
                'kd_jaringan' => $row[7],
                'latitude'    => $row[8],
                'longitude'   => $row[9],
                'ket'         => $row[10],
                'gambar_lampu'=> $row[11],
          // 'tanggal' => gmdate('Y-N-D', $tanggal),
            //untul row yang kosong
            // 'variabel' => '',
              ]);
            }
        }
    }
}
