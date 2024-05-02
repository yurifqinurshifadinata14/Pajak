<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jenis=Jenis::all();
        return view('jenis.jenis', compact('jenis'));

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
        //dd($request);
        Jenis::create([
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'npwp' => $request->npwp,
            'saham' => $request->saham,
        ]);
        return redirect()->route('jenisSub');
    }

    public function jenissub()
    {
        $jenis =  Jenis::all();
        return view('jenis.jenissub', compact('jenis'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis $jenis)
    {
        //
        $jenis = Jenis::find($jenis);
        return view('jenis.jenised', compact('jenissub'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis $jenis)
    {
        //
        Jenis::where('id', $jenis)->update([

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jenis)
    {
        //
        $jenis->delete();
        return redirect()->route('jenisSub');
    }
    
}
