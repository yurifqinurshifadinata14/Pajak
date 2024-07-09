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
use Illuminate\Support\Facades\Auth;
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
        $pph21 = new Pph21;
        $pph21->id_pajak = $request->id_pajak;
        $pph21->nik = (int) $request->nik;
        $pph21->jumlah_bayar = (int) $request->jumlah_bayar;
        $pph21->bpe = (int) $request->bpe;
        $pph21->biaya_bulan = (int) $request->biaya_bulan;
        $pph21->save();
        return response()->json('success');
    }

    public function addKaryawan(Request $request)
{
    // Check if the user has permission to add based on their role
    if (Auth::guard('admin')->check() || Auth::guard('user')->check()) {
        // Validate request data here if needed

        $karyawan = Karyawan::where('nik', $request->nik)->first();

        if ($karyawan) {
            // Update existing karyawan if found
            $karyawan->update($request->all());
        } else {
            // Create new karyawan if not found
            Karyawan::create($request->all());
        }

        // Optionally, update related Pph21 records if necessary
        if ($karyawan) {
            Pph21::where('nik', $karyawan->nik)
                ->update(['nik' => $request->nik]);
        }

        return response()->json('success');
    }

    return response()->json('Unauthorized', 403); // Return unauthorized if neither admin nor user
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
        if (Auth::guard('admin')->check()) {
            // Admin sees all data
            $pph21 = Pph21::join('karyawans', 'karyawans.nik', '=', 'pph21s.nik')
                ->join('pajaks', 'pajaks.id_pajak', '=', 'pph21s.id_pajak')
                ->get(['pph21s.id', 'pph21s.id_pajak', 'karyawans.nik', 'jumlah_bayar', 'biaya_bulan', 'bpe', 'nama_wp']);
            $pajaks = Pajak::get(['id_pajak', 'nama_wp']);
            $karyawan = Karyawan::all();
        } elseif (Auth::guard('user')->check()) {
            // User sees only their data
            $idPajak = Auth::guard('user')->user()->id_pajak;
            $pph21 = Pph21::join('karyawans', 'karyawans.nik', '=', 'pph21s.nik')
                ->join('pajaks', 'pajaks.id_pajak', '=', 'pph21s.id_pajak')
                ->where('pph21s.id_pajak', $idPajak)
                ->get(['pph21s.id', 'pph21s.id_pajak', 'karyawans.nik', 'jumlah_bayar', 'biaya_bulan', 'bpe', 'nama_wp']);
            $pajaks = Pajak::where('id_pajak', $idPajak)->get(['id_pajak', 'nama_wp']);
            $karyawan = Karyawan::where('id_pajak', $idPajak)->get();
        } else {
            return redirect()->route('admin.login');
        }

        return view('pph21.pph21sub', compact('pph21', 'pajaks', 'karyawan'));
    }


    public function pph21subUser()
{
    // Fetch data based on the authenticated user's role
    if (Auth::guard('admin')->check()) {
        // Admin sees all data
        $pph21 = Pph21::join('karyawans', 'karyawans.nik', '=', 'pph21s.nik')
            ->join('pajaks', 'pajaks.id_pajak', '=', 'pph21s.id_pajak')
            ->get(['pph21s.id', 'pph21s.id_pajak', 'karyawans.nik', 'jumlah_bayar', 'biaya_bulan', 'bpe', 'nama_wp']);
        $pajaks = Pajak::get(['id_pajak', 'nama_wp']);
        $karyawan = Karyawan::all();
    } elseif (Auth::guard('user')->check()) {
        // User sees only their data
        $idPajak = Auth::guard('user')->user()->id_pajak;
        $pph21 = Pph21::join('karyawans', 'karyawans.nik', '=', 'pph21s.nik')
            ->join('pajaks', 'pajaks.id_pajak', '=', 'pph21s.id_pajak')
            ->where('pph21s.id_pajak', $idPajak)
            ->get(['pph21s.id', 'pph21s.id_pajak', 'karyawans.nik', 'jumlah_bayar', 'biaya_bulan', 'bpe', 'nama_wp']);
        $pajaks = Pajak::where('id_pajak', $idPajak)->get(['id_pajak', 'nama_wp']);
        $karyawan = Karyawan::where('id_pajak', $idPajak)->get();
    } else {
        return redirect()->route('user.login');
    }

    return view('user.pph21sub', compact('pph21', 'pajaks', 'karyawan'));
}


    public function getPph21Sub()
    {
        $pph21 = Pph21::join('karyawans', 'karyawans.nik', '=', 'pph21s.nik')->join('pajaks', 'pajaks.id_pajak', '=', 'pph21s.id_pajak')
            ->get(['pph21s.id', 'pph21s.id_pajak', 'karyawans.nik', 'jumlah_bayar', 'biaya_bulan', 'bpe', 'nama_wp']);
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
        $pph21->bpe = $request->bpe;
        $pph21->nik = $request->nik;
        $pph21->biaya_bulan = $request->biaya_bulan;
        $pph21->save();

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
