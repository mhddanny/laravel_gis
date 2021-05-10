<?php

namespace App\Exports;

use App\Jalan;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportJalan implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jalan::all();
    }
}
