<?php

namespace App\Http\Controllers;

use App\Models\Pphunifikasi;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Imports\PphuImport;
use Maatwebsite\Excel\Facades\Excel;


class PphunifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pphunifikasi=Pphunifikasi::all();
        $pajaks = Pajak::all();
        return view('pphunifikasi.pphunifikasisub', compact('pphunifikasi', 'pajaks'));
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
        $import = Excel::import(new PphuImport(), $path);
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
        $max = DB::table('pphunifikasis')->select(DB::raw('MAX(RIGHT(id_pphuni,3)) as autoid'));
        $kd = "";

        if ($max->count() > 0) {
            foreach ($max->get() as $a) {
                $tmp = ((int) $a->autoid) + 1;
                $kd = sprintf("%03s", $tmp);
                $id_pphuni = "PPHU-" . $kd;
            }
        } else {
            $id_pphuni = "PPHU-001";
        }

        $pphunifikasi = Pphunifikasi::create([
            'id_pajak' => $request->id_pajak,
            'id_pphuni' => $id_pphuni,
            'ntpn' => (int)$request->ntpn,
            'jumlah_bayar' => (int)$request->jumlah_bayar,
            'biaya_bulan' => (int)$request->biaya_bulan,
            'bpf' => (string)$request->bpf,
        ]);
        return redirect()->route('pphunifikasiSub');
    }

    public function pphunifikasisub()
    {
       /*  $pph =  Pph::with('pajak')->get();*/
        $pajaks =  Pajak::get(['id_pajak','nama_wp']);
        $pphunifikasi = Pphunifikasi::join('pajaks','pphunifikasis.id_pajak','=','pajaks.id_pajak')->get(['pphunifikasis.id','id_pphuni','pphunifikasis.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar','bpf']);
        return view('pphunifikasi.pphunifikasisub', compact(['pphunifikasi','pajaks']));
    }

    public function getPphunifikasi(){
        $pajaks =  Pajak::get(['id_pajak','nama_wp']);
        $pphunifikasi = Pphunifikasi::join('pajaks','pphunifikasis.id_pajak','=','pajaks.id_pajak')->get(['pphunifikasis.id','id_pphuni','pphunifikasis.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar','bpf']);
        return response()->json(['pphunifikasi' => $pphunifikasi]);
    }

    // public function getPphunifikasiSub(){
    //     $pphunifikasi = Pphunifikasi::join('pajaks','pphunifikasis.id_pajak','=','pajaks.id_pajak')->get(['pphunifikasis.id','id_pphuni','pphunifikasis.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar']);
    //     return $pphunifikasi;
    // }


    /**
     * Display the specified resource.
     */
    public function show(Pphunifikasi $pphunifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pphunifikasi $pphunifikasi)
    {
        //
        return response()->json($pphunifikasi);
        //return view('pphunifikasi.pphunifikasiEdit', compact('pphunifikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_pphuni)
    {
        //
        // $pphunifikasi = Pphunifikasi::where('id', $id)->first();
        // $pphunifikasi->ntpn = $request->ntpn;
        // $pphunifikasi->jumlah_bayar = $request->jumlah_bayar;
        // $pphunifikasi->bayar_bulan = $request->bayar_bulan;
        // $pphunifikasi->bpf = $request->bpf;
        Log::info($id_pphuni);
        $pphunifikasi=Pphunifikasi::where('id_pphuni',$id_pphuni)->update([
            'ntpn' => (int)$request->ntpn,
            'jumlah_bayar' => (int)$request->jumlah_bayar,
            'biaya_bulan' => (int)$request->biaya_bulan,
            'bpf' => (string)$request->bpf,
        ]);

        return redirect()->route('pphunifikasiSub');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $pphunifikasi = Pphunifikasi::where('id_pphuni',$id)->delete();
        //$pphunifikasi->delete();
        return redirect()->route('pphunifikasiSub');
    }
}
