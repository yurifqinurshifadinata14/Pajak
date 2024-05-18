<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Pajak;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Imports\PajakImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class PajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pajak = Pajak::all();
        return view('pajak.pajaksub', compact('pajak'));
        //
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
        $import = Excel::import(new PajakImport(), $path);
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
        $max = DB::table('pajaks')->select(DB::raw('MAX(RIGHT(id_pajak,3)) as autoid'));
        $kd = "";

        if ($max->count() > 0) {
            foreach ($max->get() as $a) {
                $tmp = ((int) $a->autoid) + 1;
                $kd = sprintf("%03s", $tmp);
                $id_pajak = "P-" . $kd;
            }
        } else {
            $id_pajak = "P-001";
        }

        $pajak = new Pajak;
        $pajak->id_pajak = $id_pajak;
        $pajak->nama_wp = $request->nama_wp;
        $pajak->npwp = $request->npwp;
        $pajak->no_hp = $request->no_hp;
        $pajak->no_efin = $request->no_efin;
        $pajak->gmail = $request->gmail;
        $pajak->password = $request->password;
        $pajak->nik = $request->nik;
        $pajak->alamat = $request->alamat;
        $pajak->merk_dagang = $request->merk_dagang;

        $jenis = new Jenis();
        $jenis->id_pajak = $id_pajak;
        $jenis->jenis = $request->jenis;
        $jenis->alamatBadan = $request->alamatBadan;
        $jenis->jabatan = $request->jabatan;
        $jenis->saham = $request->saham;
        $jenis->npwpBadan = $request->npwpBadan;

        $status = new Status();
        $status->id_pajak = $id_pajak;
        $status->status = $request->status;
        $status->enofa_password = $request->enofa_password;
        $status->user_efaktur = $request->user_efaktur;
        $status->passphrese = $request->passphrese;
        $status->password_efaktur = $request->password_efaktur;

        //dd($pajak, $jenis, $status);
        if ($pajak->save() && $jenis->save() && $status->save()) {

            return redirect()->route('pajakSub');
        }
    }

    public function pajaksub()
    {
        $pajak = Pajak::join('jenis', 'jenis.id_pajak', '=', 'pajaks.id_pajak')
            ->join('statuses', 'statuses.id_pajak', '=', 'pajaks.id_pajak')
            ->get();
        //dd($pajak);
        return view('pajak.pajaksub', compact('pajak'));
    }

    public function getPajakSub()
    {
        $pajak = Pajak::join('jenis', 'jenis.id_pajak', '=', 'pajaks.id_pajak')
            ->join('statuses', 'statuses.id_pajak', '=', 'pajaks.id_pajak')
            ->get();
        return response()->json(['pajak' => $pajak]);
    }

    // public function jenissub()
    // {
    //     $jenis =  Pajak::all();
    //     return view('jenis.jenissub', compact('jenis'));
    // }

    // public function statussub()
    // {
    //     $status = Pajak::all();
    //     return view('status.statussub', compact('status'));
    // }

    /**
     * Display the specified resource.
     */
    public function show($id_pajak)
    {
        $pajak = Pajak::join('jenis', 'jenis.id_pajak', '=', 'pajaks.id_pajak')
            ->join('statuses', 'statuses.id_pajak', '=', 'pajaks.id_pajak')
            ->where('pajaks.id_pajak', $id_pajak)
            ->first();
        // dd($pajak);
        return view('pajak.pajakDetail', compact('pajak'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pajak $pajak)
    {
        //
        return view('pajak.pajakEdit', compact('pajak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pajak $pajak, $id_pajak)
    {
        //dd($request);

        $pajak = Pajak::where('id_pajak', $id_pajak)->first();
        //dd($pajak);
        $pajak->nama_wp = $request->nama_wp;
        $pajak->npwp = $request->npwp;
        $pajak->no_hp = $request->no_hp;
        $pajak->no_efin = $request->no_efin;
        $pajak->gmail = $request->gmail;
        $pajak->password = $request->password;
        $pajak->nik = $request->nik;
        $pajak->alamat = $request->alamat;
        $pajak->merk_dagang = $request->merk_dagang;

        $jenis = Jenis::where('id_pajak', $id_pajak)->first();
        if ($request->jenis == 'Pribadi') {
            $jenis->jenis = $request->jenis;
            $jenis->alamatBadan = null;
            $jenis->jabatan = null;
            $jenis->saham = null;
            $jenis->npwpBadan = null;
        } else {
            $jenis->jenis = $request->jenis;
            $jenis->alamatBadan = $request->alamatBadan;
            $jenis->jabatan = $request->jabatan;
            $jenis->saham = $request->saham;
            $jenis->npwpBadan = $request->npwpBadan;
        }

        $status = Status::where('id_pajak', $id_pajak)->first();
        if ($request->status == 'PKP') {
            $status->status = $request->status;
            $status->enofa_password = $request->enofa_password;
            $status->user_efaktur = $request->user_efaktur;
            $status->passphrese = $request->passphrese;
            $status->password_efaktur = $request->password_efaktur;
        } else {
            $status->status = $request->status;
            $status->enofa_password = null;
            $status->user_efaktur = null;
            $status->passphrese = null;
            $status->password_efaktur = null;
        }

        if ($pajak->save() && $jenis->save() && $status->save()) {
            return redirect()->route('pajakSub');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_pajak)
    {
        //
        /* $id_pajak->delete(); */
        $pajak = Pajak::where('id_pajak', $id_pajak)->delete();
        Jenis::where('id_pajak', $id_pajak)->delete();
        Status::where('id_pajak', $id_pajak)->delete();
        return redirect()->route('pajakSub');
    }
}
