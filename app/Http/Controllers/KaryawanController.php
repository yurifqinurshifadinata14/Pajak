<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $karyawan = Karyawan::all();
        return view('karyawan.karyawan', compact('karyawan'));
    }

    public function import_excel(Request $request)
	{
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = $file->hashName();
        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);
        //dd($path);
        // import data
        $import = Excel::import(new KaryawanImport(), $path);
        //remove from server
        //Storage::delete($path);
        if($import) {
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
        //
        $max = DB::table('pph21s')->select(DB::raw('MAX(RIGHT(id_pph21,3)) as autoid'));
        $kd = "";

        if ($max->count() > 0) {
            foreach ($max->get() as $a) {
                $tmp = ((int) $a->autoid) + 1;
                $kd = sprintf("%03s", $tmp);
                $id_pph21 = "Pph21-" . $kd;
            }
        } else {
            $id_pph21 = "Pph21-001";
        }

        $karyawan = Karyawan::create([
            'id_pph21' => null,
            'nik' => $request->nik,
            'npwp' => $request->npwp,

        ]);
        return redirect()->route('karyawanSub');
    }
    public function karyawansub()
    {
        $karyawan = karyawan::all();
        return view('karyawan.karyawansub', compact('karyawan'));
    }

    public function getKaryawan()
    {
        $karyawan = Karyawan::all();
        return $karyawan;
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        //
        return view('karyawan.karyawanEdit', compact('karyawan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->nama = $request->nama;
        $karyawan->nik = $request->nik;
        $karyawan->npwp = $request->npwp;
        $karyawan->save();

        return response()->json(['success' => true]);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        //
    }
}
