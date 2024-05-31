<?php

namespace App\Http\Controllers;

use App\Models\Pajak;
use App\Models\Pph21;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Routing\Matcher\TraceableUrlMatcher;
use App\Imports\Pph21Import;
use App\Exports\Pph21Export;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

class Pph21Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pph21 = Pph21::all();
        return view('pph21.pph21sub', compact('pph21'));
    }

    public function export_excel_pph21()
    {
        return Excel::download(new Pph21Export(), 'pph21.xlsx');
    }

    public function import_excel(Request $request)
    {
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = $file->hashName();
        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);
        //dd($path);
        // import data
        $import = Excel::import(new Pph21Import(), $path);
        //remove from server
        //Storage::delete($path);
        if ($import) {
            //redirect
            return redirect()->back()->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->back()->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*  $max = DB::table('pph21s')->select(DB::raw('MAX(RIGHT(id_pph21,3)) as autoid'));
        $kd = "";

        if ($max->count() > 0) {
            foreach ($max->get() as $a) {
                $tmp = ((int) $a->autoid) + 1;
                $kd = sprintf("%03s", $tmp);
                $id_pph21 = "Pph21-" . $kd;
            }
        } else {
            $id_pph21 = "Pph21-001";
        } */
        //
        $pph21 = new Pph21;
        $pph21->id_pajak = $request->id_pajak;
        $pph21->nik = (int) $request->nik;
        $pph21->jumlah_bayar = (int) $request->jumlah_bayar;
        $pph21->bpf = (int) $request->bpf;
        $pph21->biaya_bulan = (int) $request->biaya_bulan;
        $pph21->save();

        /*  $karyawan = new Karyawan();
        $karyawan->id_pph21 = $id_pph21;
        $karyawan->id_pph21 = $id_pph21;
        $karyawan->npwp = (int) $request->npwp;
        $karyawan->nik = (int) $request->nik;
        $karyawan->save(); */

        /* if ($pph21->save() && $karyawan->save()) {

            return redirect()->route('pph21Sub');

        } */

        // $pph21 = Pph21::create([
        //     'id_pajak' => $request->id_pajak,
        //     'id_pph21' => $request->id_pph21,
        //     'jumlah_bayar' => $request->jumlah_bayar,
        //     'bpf' => $request->bpf,
        //     'biaya_bulan' => $request->biaya_bulan,
        //     'karyawan' => $request->karyawan,
        // ]);
        return response()->json('success');
    }

    public function addKaryawan(Request $request)
    {
        $karyawan = Karyawan::where('id', $request->id)->first();
        Karyawan::updateOrCreate(['id' => $request->id], $request->all());
        $pph21 = Pph21::where('nik', $karyawan->nik)->update(['nik' => $request->nik]);
    }

    public function deleteKaryawan($id)
    {
        Karyawan::where('id', $id)->delete();
    }

    public function getKaryawan()
    {
        $karyawan = Karyawan::all();
        return $karyawan;
    }

    public function pph21sub()
    {

        $pajaks = Pajak::get(['id_pajak', 'nama_wp']);
        $karyawan = Karyawan::all();
        $pph21 = Pph21::join('karyawans', 'karyawans.nik', '=', 'pph21s.nik')->join('pajaks', 'pajaks.id_pajak', '=', 'pph21s.id_pajak')
            ->get(['pph21s.id', 'pph21s.id_pajak', 'karyawans.nik', 'jumlah_bayar', 'biaya_bulan', 'bpf', 'nama_wp']);
        // dd($pph21);
        return view('pph21.pph21sub', compact(['pph21', 'pajaks', 'karyawan']));
    }

    public function getPph21Sub()
    {
        $pph21 = Pph21::join('karyawans', 'karyawans.nik', '=', 'pph21s.nik')->join('pajaks', 'pajaks.id_pajak', '=', 'pph21s.id_pajak')
            ->get(['pph21s.id', 'pph21s.id_pajak', 'karyawans.nik', 'jumlah_bayar', 'biaya_bulan', 'bpf', 'nama_wp']);
        return response()->json(['pph21' => $pph21]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pph21 $id_pph21)
    {
        $pph21 = Pph21::join('pph21', 'pph21.id_pph21', '=', 'pph21s.id_pph21')
            ->join('karyawans', 'karyawans.id_pph21', '=', 'pph21s.id_pph21')
            ->where('pph21s.id_pph21', $id_pph21)
            ->first();
        // dd($pph21);
        // return view('pph21.pph21Detail', compact('pph21'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pph21 $pph21)
    {
        //
        return view('pph21.pph21Edit', compact('pph21'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pph21 $pph21, $id)
    {
        //
        $pph21 = Pph21::where('id', $id)->first();
        $pph21->jumlah_bayar = $request->jumlah_bayar;
        $pph21->bpf = $request->bpf;
        $pph21->nik = $request->nik;
        $pph21->biaya_bulan = $request->biaya_bulan;
        $pph21->save();

        /*  $karyawan = Karyawan::where('id_pph21', $id_pph21)->first();
        $karyawan->nik = $request->nik;
        $karyawan->npwp = $request->npwp;
        $karyawan->save(); */


        // $pph21->update([
        //     'jumlah_bayar' => $request->jumlah_bayar,
        //     'bpf' => $request->bpf,
        //     'biaya_bulan' => $request->biaya_bulan,
        //     'karyawan' => $request->karyawan,
        // ]);

        return redirect()->route('pph21Sub');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $pph21 = Pph21::where('id', $id)->delete();
        // $pph21->delete();
        return redirect()->route('pph21Sub');
    }
}
