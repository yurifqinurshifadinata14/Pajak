<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pph21;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Pph21Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $pph21 = Pph21::all();
        return response()->json([
            'pph21' => $pph21
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
        $validated = Validator::make($request->all(), [
            'id_pajak' => 'required',
            'nik' => 'required',
            'jumlah_bayar' => 'required',
            'bpf' => 'required',
            'biaya_bulan' => 'required',

        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => $validated->messages(),
            ]);
        } else {
            PPh21::create([
                'id_pajak' => $request->id_pajak,
                'nik' => $request->nik,
                'jumlah_bayar' => $request->jumlah_bayar,
                'bpf' => $request->bpf,
                'biaya_bulan' => $request->biaya_bulan,

            ]);

            return response()->json([
                'message' => "Data telah tersimpan",
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'nik' => 'numeric',
            'jumlah_bayar' => 'numeric',
            'bpf' => 'numeric',
            'biaya_bulan' => 'numeric',

        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => $validated->messages(),
            ]);
        } else {
            $pph21 = Pph21::where('id', $id)->update([
                'nik' => (int) $request->nik,
                'jumlah_bayar' => (int) $request->jumlah_bayar,
                'bpf' => (int) $request->bpf,
                'biaya_bulan' => (int) $request->biaya_bulan,
            ]);

            return response()->json([
                'message' => "Data telah tersimpan",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $pph21 = Pph21::where('id', $id)->first();

        if (!$pph21) {
            return response()->json([
                'message' => "Data tidak bisa terhapus",
            ]);
        }

        $pph21->delete();

        return response()->json([
            'message' => "Data telah terhapus",
        ]);
    }
}
