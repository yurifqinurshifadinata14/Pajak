<?php

namespace App\Http\Controllers;
use App\Models\Pajak;
use App\Models\Karyawan;
use App\Models\Beranda;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayar = Pajak::all();
        $totalpembayar = Pajak::count();
        $jumlahkaryawan = Karyawan::count();


        return view('beranda',[
            'totalpembayar' => $totalpembayar,
            'jumlahkaryawan'=> $jumlahkaryawan
        ]
    
    );
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Beranda $beranda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beranda $beranda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Beranda $beranda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beranda $beranda)
    {
        //
    }
}
