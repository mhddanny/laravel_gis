<?php

namespace App\Exports;

use App\Travo;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTravo implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
          return Travo::all();
    }
}
