<?php

namespace App\Http\Controllers;

use App\Models\Pph;
use Illuminate\Http\Request;

class PphController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pph =  Pph::all();
        return view ('pph.pph',compact('pph'));
        //
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
        $pph = Pph::create([
            'id_pph' => null,
            'ntpn' => $request->ntpn,
            'biaya_bulan' => $request->biaya_bulan,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect()->route('pphSub');
        //
    }

    public function pphsub()
    {
        $pph =  Pph::all();
        return view('pph.pphsub', compact('pph'));
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
    public function edit(Pph $pph)
    {
        return view('pph.pphEdit', compact('pph'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pph $pph)
    {
        $pph->update([
            'ntpn' => $request->ntpn,
            'biaya_bulan' => $request->biaya_bulan,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect()->route('pphSub');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pph $pph)
    {
        $pph->delete();
        return redirect()->route('pphSub');
        //
    }
}
