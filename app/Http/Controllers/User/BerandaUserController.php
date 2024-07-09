<?php

namespace App\Http\Controllers\User;
use App\Models\Pajak;
use App\Models\Karyawan;
use App\Models\Pph;
use App\Models\Pph21;
use App\Models\Beranda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaUserController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $totalpembayar = Pajak::count();
            $jumlahkaryawan = Karyawan::count();
            $totalbayarpph = Pph::sum('jumlah_bayar');
            $totalbayarpph21 = Pph21::sum('jumlah_bayar');
        } elseif (Auth::guard('user')->check()) {
            $id_pajak = Auth::guard('user')->user()->id_pajak;
            $totalpembayar = Pajak::where('id_pajak', $id_pajak)->count();
            $jumlahkaryawan = Karyawan::where('id_pajak', $id_pajak)->count();
            $totalbayarpph = Pph::whereHas('pajak', function ($query) use ($id_pajak) {
                $query->where('id_pajak', $id_pajak);
            })->sum('jumlah_bayar');
            $totalbayarpph21 = Pph21::whereHas('pajak', function ($query) use ($id_pajak) {
                $query->where('id_pajak', $id_pajak);
            })->sum('jumlah_bayar');
        } else {
            return redirect()->route('user.login');
        }
    
        return view('user.beranda', compact('totalpembayar', 'jumlahkaryawan', 'totalbayarpph', 'totalbayarpph21'));
    }
    
    public function getData()
    {
        if (Auth::guard('admin')->check()) {
            $totalpembayar = Pajak::count();
            $jumlahkaryawan = Karyawan::count();
            $totalbayarpph = Pph::sum('jumlah_bayar');
            $totalbayarpph21 = Pph21::sum('jumlah_bayar');
        } elseif (Auth::guard('user')->check()) {
            $id_pajak = Auth::guard('user')->user()->id_pajak;
            $totalpembayar = Pajak::where('id_pajak', $id_pajak)->count();
            $jumlahkaryawan = Karyawan::where('id_pajak', $id_pajak)->count();
            $totalbayarpph = Pph::whereHas('pajak', function ($query) use ($id_pajak) {
                $query->where('id_pajak', $id_pajak);
            })->sum('jumlah_bayar');
            $totalbayarpph21 = Pph21::whereHas('pajak', function ($query) use ($id_pajak) {
                $query->where('id_pajak', $id_pajak);
            })->sum('jumlah_bayar');
        } else {
            // Handle unauthorized access
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        return response()->json([
            'totalpembayar' => $totalpembayar,
            'jumlahkaryawan' => $jumlahkaryawan,
            'totalbayarpph' => $totalbayarpph,
            'totalbayarpph21' => $totalbayarpph21
        ]);
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