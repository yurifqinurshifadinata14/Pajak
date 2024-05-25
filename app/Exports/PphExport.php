<?php

namespace App\Exports;
use App\Models\Pph;
use Maatwebsite\Excel\Concerns\FromCollection;

class PphExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pph::all();

    }
}
