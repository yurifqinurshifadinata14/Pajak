<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $karyawan =  Karyawan::all();
        return response()->json([
            'karyawan' => $karyawan
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
            'nama' => 'required|max:255',
            'nik' => 'required',
            'npwp' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => $validated->messages(),
            ]);
        } else {
            Karyawan::create([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'npwp' => $request->npwp,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}