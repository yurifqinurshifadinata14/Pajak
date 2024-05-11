<?php

namespace App\Http\Controllers;

use App\Models\Pph;
use App\Models\Pajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PphController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pph =  Pph::all();
        $pajaks = Pajak::all();
        return view('pph.pph', compact('pph', 'pajaks'));
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
        $max = DB::table('pphs')->select(DB::raw('MAX(RIGHT(id_pph,3)) as autoid'));
        $kd = "";

        if ($max->count() > 0) {
            foreach ($max->get() as $a) {
                $tmp = ((int) $a->autoid) + 1;
                $kd = sprintf("%03s", $tmp);
                $id_pph = "PPH-" . $kd;
            }
        } else {
            $id_pph = "PPH-001";
        }

        $pph = Pph::create([
            'id_pajak' => $request->id_pajak,
            'id_pph' => $id_pph,
            'ntpn' => (int)$request->ntpn,
            'biaya_bulan' => (int)$request->biaya_bulan,
            'jumlah_bayar' => (int)$request->jumlah_bayar,
        ]);

        return redirect()->route('pphSub');
        //
    }

    public function pphsub()
    {
       /*  $pph =  Pph::with('pajak')->get();*/
        $pajaks =  Pajak::get(['id_pajak','nama_wp']);
        $pph = Pph::join('pajaks','pphs.id_pajak','=','pajaks.id_pajak')->get(['pphs.id','id_pph','pphs.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar']);
        return view('pph.pphsub', compact(['pph','pajaks']));
    }

    public function getPph(){
        $pph = Pph::join('pajaks','pphs.id_pajak','=','pajaks.id_pajak')->get(['pphs.id','id_pph','pphs.id_pajak','nama_wp','ntpn','biaya_bulan','jumlah_bayar']);
        return $pph;
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
        return response()->json($pph);
        // return view('pph.pphEdit', compact('pph'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_pph)
    {
        $pph=Pph::where('id_pph',$id_pph)->update([
            'ntpn' => (int)$request->ntpn,
            'biaya_bulan' => (int)$request->biaya_bulan,
            'jumlah_bayar' => (int)$request->jumlah_bayar,
        ]);

        return redirect()->route('pphSub');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
 
        $pph = Pph::where('id_pph',$id)->delete();
        return redirect()->route('pphSub');
        //
    }
}