<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Pajak;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $max = DB::table('pajaks')->select(DB::raw('MAX(RIGHT(id_pajak,3)) as autoid'));
        $kd = "";
        
        if ($max->count() > 0) {
            foreach ($max->get() as $a) {
                $tmp = ((int) $a->max) + 1;
                $kd = sprintf("%03s", $tmp);
                $id_pajak = "P-".$kd;
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
        $jenis->alamat = $request->alamatBadan;
        $jenis->jabatan = $request->jabatanBadan;
        $jenis->saham = $request->sahamBadan;
        $jenis->npwp = $request->npwpBadan;
    
        $status = new Status(); 
        $status->id_pajak = $id_pajak;
        $status->status = $request->status;
        $status->enofa_password = $request->enofa_password;
        $status->user_efaktur = $request->user_efaktur;
        $status->passphrase = $request->passphrase; 
        $status->password_efaktur = $request->password_efaktur;
    
        if ($pajak->save() && $jenis->save() && $status->save()) {
    
            return response([
                "message" => "Pajak Created Successfully"
            ], 201);
        }
    
        return redirect()->route('pajakSub');
    }

    public function pajaksub()
    {
        $pajak =  Pajak::all();
        //dd($pajak);
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
