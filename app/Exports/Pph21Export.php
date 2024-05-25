<?php

namespace App\Exports;
use App\Models\Pph21;
use Maatwebsite\Excel\Concerns\FromCollection;

class Pph21Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pph21::all();

    }
}
