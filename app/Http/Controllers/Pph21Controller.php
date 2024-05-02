<?php

namespace App\Http\Controllers;

use App\Models\Pph21;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Matcher\TraceableUrlMatcher;

class Pph21Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pph21 =  Pph21::all();
        return view('pph21.pph21', compact ('pph21'));
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
        $pph21 = Pph21::create([
            'jumlah_bayar' => $request->jumlah_bayar,
            'bpf' => $request->bpf,
            'biaya_bulan' => $request->biaya_bulan,
            'daftar_karyawan' => $request->daftar_karyawan,
        ]);
        return redirect()->route('pph21Sub'); 
    }

    public function pph21sub()
    {
        $pph21 =  Pph21::all();
        return view('pph21.pph21sub', compact('pph21'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pph21 $pph21)
    {
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
    public function update(Request $request, Pph21 $pph21)
    {
        //
        $pph21->update([
            'jumlah_bayar' => $request->jumlah_bayar,
            'bpf' => $request->bpf,
            'biaya_bulan' => $request->biaya_bulan,
            'daftar_karyawan' => $request->daftar_karyawan,
        ]);

        return redirect()->route('pph21Sub');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pph21 $pph21)
    {
        //
        $pph21->delete();
        return redirect()->route('pph21Sub');
    }
}
