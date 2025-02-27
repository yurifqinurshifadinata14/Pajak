<?php

namespace App\Http\Controllers;

use App\Models\Pphunifikasi;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Imports\PphuImport;
use App\Exports\PphunifikasiExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

class PphunifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Auth::guard('admin')->check()) {
        //     $pph = Pphunifikasi::join('pajaks', 'pphunifikasis.id_pajak', '=', 'pajaks.id_pajak')
        //         ->select('pphunifikasis.*', 'pajaks.nama_wp')
        //         ->get();
        //     $pajaks = Pajak::all();
        // } elseif (Auth::guard('user')->check()) {
        //     $pph = Pphunifikasi::join('pajaks', 'pphunifikasis.id_pajak', '=', 'pajaks.id_pajak')
        //         ->where('pphunifikasis.id_pajak', Auth::guard('user')->user()->id_pajak)
        //         ->select('pphunifikasis.*', 'pajaks.nama_wp')
        //         ->get();
        //     $pajaks = Pajak::where('id_pajak', Auth::guard('user')->user()->id_pajak)->get();
        // } else {
        //     return redirect()->route('login');
        // }
    
        // return view('pphunifikasi.pphunifikasisub', compact('pph', 'pajaks'));
    }

    public function export_excel_pphuni()
    {
        return Excel::download(new PphunifikasiExport(), 'pph_unifikasi.xlsx');
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
            'bpe' => (string)$request->bpe,
        ]);
        return redirect()->route('pphunifikasiSub');
    }

    public function pphunifikasisub()
    {
        if (Auth::guard('admin')->check()) {
            $pphunifikasi = Pphunifikasi::join('pajaks', 'pphunifikasis.id_pajak', '=', 'pajaks.id_pajak')
                ->select('pphunifikasis.*', 'pajaks.nama_wp')
                ->get();
            $pajaks = Pajak::all();
        } elseif (Auth::guard('user')->check()) {
            $pphunifikasi = Pphunifikasi::join('pajaks', 'pphunifikasis.id_pajak', '=', 'pajaks.id_pajak')
                ->where('pphunifikasis.id_pajak', Auth::guard('user')->user()->id_pajak)
                ->select('pphunifikasis.*', 'pajaks.nama_wp')
                ->get();
            $pajaks = Pajak::where('id_pajak', Auth::guard('user')->user()->id_pajak)->get();
        } else {
            return redirect()->route('login');
        }
        return view('pphunifikasi.pphunifikasisub', compact('pphunifikasi', 'pajaks'));
    }
    public function pphunifikasisubUser()
    {
        if (Auth::guard('admin')->check()) {
            $pphunifikasi = Pphunifikasi::join('pajaks', 'pphunifikasis.id_pajak', '=', 'pajaks.id_pajak')
                ->select('pphunifikasis.*', 'pajaks.nama_wp')
                ->get();
            $pajaks = Pajak::all();
        } elseif (Auth::guard('user')->check()) {
            $pphunifikasi = Pphunifikasi::join('pajaks', 'pphunifikasis.id_pajak', '=', 'pajaks.id_pajak')
                ->where('pphunifikasis.id_pajak', Auth::guard('user')->user()->id_pajak)
                ->select('pphunifikasis.*', 'pajaks.nama_wp')
                ->get();
            $pajaks = Pajak::where('id_pajak', Auth::guard('user')->user()->id_pajak)->get();
        } else {
            return redirect()->route('login');
        }
        return view('user.pphunifikasisub', compact('pphunifikasi', 'pajaks'));
    }

    public function getPphunifikasi(){
        $pajaks =  Pajak::get(['id_pajak','nama_wp']);
        $pphunifikasi = Pphunifikasi::join('pajaks','pphunifikasis.id_pajak','=','pajaks.id_pajak')->get(['pphunifikasis.id','id_pphuni','pphunifikasis.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar','bpe']);
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
        // $pphunifikasi->bpe = $request->bpe;
        Log::info($id_pphuni);
        $pphunifikasi=Pphunifikasi::where('id_pphuni',$id_pphuni)->update([
            'ntpn' => (int)$request->ntpn,
            'jumlah_bayar' => (int)$request->jumlah_bayar,
            'biaya_bulan' => (int)$request->biaya_bulan,
            'bpe' => (string)$request->bpe,
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
