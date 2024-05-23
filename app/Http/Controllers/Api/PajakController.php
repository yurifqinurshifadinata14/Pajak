<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\Pajak;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PajakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $pajak =  Pajak::all();
        return response()->json([
            'pajak' => $pajak
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
        $validated = Validator::make($request->all(), [
            'id_pajak' => 'required',
            'nama_wp' => 'required|max:255',
            'npwp' => 'required',
            'no_hp' => 'required',
            'no_efin' => 'required',
            'gmail' => 'required',
            'password' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'merk_dagang' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'error' => $validated->errors()->first(),
            ], 422);
        }

        $pajak = Pajak::create($request->all());

        if ($pajak) {
            return response()->json([
                'message' => "Data telah tersimpan",
                'pajak' => $pajak,
            ], 201);
        } else {
            return response()->json([
                'error' => "Gagal menyimpan data",
            ], 500);
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
    public function update(Request $request, $id_pajak)
    {
        // Validasi data yang diterima dari request
        $validated = Validator::make($request->all(), [
            'nama_wp' => 'string|max:255',
            'npwp' => 'string|max:255',
            'no_hp' => 'string|max:255',
            'no_efin' => 'string|max:255',
            'gmail' => 'email',
            'password' => 'string',
            'nik' => 'string|max:255',
            'alamat' => 'string|max:255',
            'merk_dagang' => 'string|max:255',
        ]);

        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validated->fails()) {
            return response()->json([
                'message' => $validated->messages(),
            ], 400);
        }

        // Temukan data Pajak berdasarkan id_pajak
        $pajak = Pajak::where('id_pajak', $id_pajak)->first();

        // Perbarui data Pajak dengan data yang diterima dari request
        if(!$pajak) {
            return response()->json([
                'message' => "Data pajak dengan ID $id_pajak tidak ditemukan",
            ], 404);
        }

        $pajak->update($request->all());

        // Kembalikan respons JSON yang menyatakan data telah tersimpan
        return response()->json([
            'message' => "Data telah tersimpan",
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_pajak)
    {
        // Temukan data Pajak berdasarkan id_pajak
        $pajak = Pajak::where('id_pajak', $id_pajak)->first();

        // Periksa apakah data Pajak ditemukan
        if (!$pajak) {
            return response()->json([
                'message' => "Data pajak dengan ID $id_pajak tidak ditemukan",
            ], 404);
        }

        // Hapus data Pajak
        $pajak->delete();

        // Kembalikan respons sukses
        return response()->json([
            'message' => "Data pajak dengan ID $id_pajak berhasil dihapus",
        ]);
    }

}
