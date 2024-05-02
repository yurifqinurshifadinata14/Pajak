<?php

namespace App\Http\Controllers;

use App\Models\Pphunifikasi;
use Illuminate\Http\Request;

class PphunifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pphunifikasi=PphUnifikasi::all();
        return view('pphunifikasi.pphunifikasi', compact('pphunifikasi'));
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
        PphUnifikasi::create([
            'ntpn' => $request->ntpn,
            'jumlah_bayar' => $request->jumlah_bayar,
            'biaya_bulan' => $request->biaya_bulan,
            'bpf' => $request->bpf,
        ]);
        return redirect()->route('pphunifikasiSub');
    }

    public function pphunifikasisub()
    {
        $pphunifikasi =  PphUnifikasi::all();
        return view('pphunifikasi.pphunifikasisub', compact('pphunifikasi'));
    }


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
        return view('pphunifikasi.pphunifikasiEdit', compact('pphunifikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pphunifikasi $pphunifikasi)
    {
        //
        $pphunifikasi->update([
            'ntpn' => $request->ntpn,
            'jumlah_bayar' => $request->jumlah_bayar,
            'biaya_bulan' => $request->biaya_bulan,
            'bpf' => $request->bpf,
        ]);

        return redirect()->route('pphunifikasiSub');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pphunifikasi $pphunifikasi)
    {
        //
        $pphunifikasi->delete();
        return redirect()->route('pphunifikasiSub');
    }
}
