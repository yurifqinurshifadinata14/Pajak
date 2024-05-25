<?php

namespace App\Exports;
use App\Models\Pphunifikasi;
use Maatwebsite\Excel\Concerns\FromCollection;

class PphunifikasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pphunifikasi::all();

    }
}
