<?php

namespace App\Http\Controllers;

use App\Models\Pph;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\PphImport;
use App\Exports\PphExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

class PphController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   // Controller PphController
   public function index()
{
    if (Auth::guard('admin')->check()) {
        $pph = Pph::join('pajaks', 'pphs.id_pajak', '=', 'pajaks.id_pajak')
            ->select('pphs.*', 'pajaks.nama_wp')
            ->get();
        $pajaks = Pajak::all();
    } elseif (Auth::guard('user')->check()) {
        $pph = Pph::join('pajaks', 'pphs.id_pajak', '=', 'pajaks.id_pajak')
            ->where('pphs.id_pajak', Auth::guard('user')->user()->id_pajak)
            ->select('pphs.*', 'pajaks.nama_wp')
            ->get();
        $pajaks = Pajak::where('id_pajak', Auth::guard('user')->user()->id_pajak)->get();
    } else {
        return redirect()->route('login');
    }

    return view('pph.pphsub', compact('pph', 'pajaks'));
}
   public function indexUser()
{
    if (Auth::guard('admin')->check()) {
        $pph = Pph::join('pajaks', 'pphs.id_pajak', '=', 'pajaks.id_pajak')
            ->select('pphs.*', 'pajaks.nama_wp')
            ->get();
        $pajaks = Pajak::all();
    } elseif (Auth::guard('user')->check()) {
        $pph = Pph::join('pajaks', 'pphs.id_pajak', '=', 'pajaks.id_pajak')
            ->where('pphs.id_pajak', Auth::guard('user')->user()->id_pajak)
            ->select('pphs.*', 'pajaks.nama_wp')
            ->get();
        $pajaks = Pajak::where('id_pajak', Auth::guard('user')->user()->id_pajak)->get();
    } else {
        return redirect()->route('login');
    }

    return view('user.pphsub', compact('pph', 'pajaks'));
}

    public function export_excel_pph()
    {
        return Excel::download(new PphExport(), 'pph.xlsx');
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
        $import = Excel::import(new PphImport(), $path);
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
        // Generate ID
        $max = DB::table('pphs')->select(DB::raw('MAX(RIGHT(id_pph,3)) as autoid'));
        $kd = "";
        if ($max->count() > 0) {
            foreach ($max->get() as $a) {
                $tmp = ((int) $a->autoid) + 1;
                $kd = sprintf("%03s", $tmp);
                $id_pph = "PPH-" . $kd;
            }
        } else {
            $id_pph = "PPH-001";
        }
    
        Pph::create([
            'id_pajak' => $request->id_pajak,
            'id_pph' => $id_pph,
            'ntpn' => (int)$request->ntpn,
            'biaya_bulan' => (int)$request->biaya_bulan,
            'jumlah_bayar' => (int)$request->jumlah_bayar,
        ]);
    
        // Get updated data for the user
        $pph = Pph::join('pajaks', 'pphs.id_pajak', '=', 'pajaks.id_pajak')
            ->where('pphs.id_pajak', Auth::guard('user')->user()->id_pajak)
            ->select('pphs.*', 'pajaks.nama_wp')
            ->get();
    
        return view('user.pphsub', compact('pph'));
    }
    

    public function pphsub()
    {
       /*  $pph =  Pph::with('pajak')->get();*/
        $pajaks =  Pajak::get(['id_pajak','nama_wp']);
        $pph = Pph::join('pajaks','pphs.id_pajak','=','pajaks.id_pajak')->get(['pphs.id','id_pph','pphs.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar']);
        return view('pph.pphsub', compact(['pph','pajaks']));
    }

    public function getPph(){
        $pph = Pph::join('pajaks','pphs.id_pajak','=','pajaks.id_pajak')->get(['pphs.id','id_pph','pphs.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar']);
        return $pph;
    }

    /**
     * Display the specified resource.
     */
    public function show(Pph $pph)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
 * Show the form for editing the specified resource.
 */
public function edit(Pph $pph)
{
    return response()->json($pph);
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id_pph)
{
    $pph = Pph::where('id_pph', $id_pph)->first();

    if (!$pph) {
        abort(404); // Not Found
    }

    // Lakukan pembaruan data
    $pph->update([
        'ntpn' => (int)$request->ntpn,
        'biaya_bulan' => (int)$request->biaya_bulan,
        'jumlah_bayar' => (int)$request->jumlah_bayar,
    ]);

    return redirect()->route('user.pphsub');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pph = Pph::where('id_pph', $id)->delete();
    
        if ($pph) {
            return redirect()->route('pphSub')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('pphSub')->with('error', 'Data tidak ditemukan atau gagal menghapus data.');
        }
    }
    

    
}
