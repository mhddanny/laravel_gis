<?php

namespace App\Exports;

use App\Panel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPanel implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
          return Panel::all();
    }
}
