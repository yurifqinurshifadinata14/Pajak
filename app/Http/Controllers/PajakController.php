<?php

namespace App\Http\Controllers;

use App\Models\Pajak;
use Illuminate\Http\Request;

class PajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pajak =  Pajak::all();
        return view('pajak.pajak', compact ('pajak'));
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
        Pajak::create([
            'nama_wp' => $request->nama_wp,
            'npwp' => $request->npwp,
            'no_hp' => $request->no_hp,
            'no_efin' => $request->no_efin,
            'gmail' => $request->gmail,
            'password' => $request->password,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'merk_dagang' => $request->merk_dagang,
        ]);

        return redirect()->route('pajakSub');
    }

    public function pajaksub()
    {
        $pajak =  Pajak::all();
        return view('pajak.pajaksub', compact('pajak'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Pajak $pajak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pajak $pajak)
    {
        $pajak = Pajak::find($pajak);
        return view('pajak.pajaked',compact('pajaksub'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pajak $pajak)
    {
        $request->validate([
            'nama_wp'=>'required',
            'npwp'=>'required',
            'no_hp'=>'required',
            'no_efin'=>'required',
            'gmail'=>'required',
            'password'=>'required',
            'nik'=>'required',
            'alamat'=>'required',
            'merk_dagang'=>'required',

        ]);
        
        $result = Pajak::find($pajak)->update([
            'nama_wp' => $request->nama_wp,
            'npwp' => $request->npwp,
            'no_hp' => $request->no_hp,
            'no_efin' => $request->no_efin,
            'gmail' => $request->gmail,
            'password' => $request->password,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'merk_dagang' => $request->merk_dagang,
        ]);

        return redirect('/pajaksub')->with('success','Data berhasil diubah');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pajak $pajak)
    {
        //
    }
}
