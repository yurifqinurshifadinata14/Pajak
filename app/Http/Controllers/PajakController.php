<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Pajak;
use App\Models\Status;
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
        $pajak = Pajak::create([
            'id_user' => null,
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

        Jenis::create([
            'id_pajak' => $pajak->id,
            'jenis' => $request->jenis,
            'alamat' => $request->alamatBadan ? $request->alamatBadan : null,
            'jabatan' => $request->jabatanBadan ? $request->jabatanBadan : null,
            'saham' => $request->sahamBadan ? $request->sahamBadan : null,
            'npwp' => $request->npwpBadan ? $request->npwpBadan : null,
        ]);

        Status::create([
            'id_pajak' => $pajak->id,
            'status' => $request->status,
            'enofa_password' => $request->enofa_password ? $request->enofa_password : null,
            'user_efaktur' => $request->user_efaktur ? $request->user_efaktur : null,
            'passphrese' => $request->passphrese ? $request->passphrese : null,
            'password_efaktur' => $request->password_efaktur ? $request->password_efaktur : null,
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
        //
        return view('pajak.pajakEdit', compact('pajak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pajak $pajak)
    {
        //
        $pajak->update([
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pajak $pajak)
    {
        //
        $pajak->delete();
        return redirect()->route('pajakSub');
}
}
