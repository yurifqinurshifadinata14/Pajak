<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class KaryawanImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $max = DB::table('pph21s')->select(DB::raw('MAX(RIGHT(id_pph21,3)) as autoid'));
        // $kd = "";

        // if ($max->count() > 0) {
        //     foreach ($max->get() as $a) {
        //         $tmp = ((int) $a->autoid) + 1;
        //         $kd = sprintf("%03s", $tmp);
        //         $id_pph21 = "Pph21-" . $kd;
        //     }
        // } else {
        //     $id_pph21 = "Pph21-001";
        // }

        return new Karyawan([
            //
            'nama' => $row['nama'],
            'nik' => $row['nik'],
            'npwp' => $row['npwp'],
        ]);
    }
}
