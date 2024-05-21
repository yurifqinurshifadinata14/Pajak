<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pphunifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PphunifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
       $pphunifikasi =  Pphunifikasi::all();
        return response()->json([
            'pphunifikasi' =>$pphunifikasi
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
            'id_pphuni' => 'required',
            'ntpn' => 'required',
            'jumlah_bayar' => 'required',
            'biaya_bulan' => 'required',
            'bpf' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => $validated->messages(),
            ]);
        } else {
            $max = DB::table('pphunifikasis')->select(DB::raw('MAX(RIGHT(id_pphuni,3)) as autoid'));
            $kd = "";

            if ($max->count() > 0) {
                foreach ($max->get() as $a) {
                    $tmp = ((int) $a->autoid) + 1;
                    $kd = sprintf("%03s", $tmp);
                    $id_pphuni = "PPHU-" . $kd;
                }
            } else {
                $id_pphuni = "PPHU-001";
            }

            Pphunifikasi::create([
                'id_pajak' => $request->$id_pajak,
                'id_pphuni' => $id_pphuni,
                'ntpn' => $request->ntpn,
                'jumlah_bayar' => $request->jumlah_bayar,
                'biaya_bulan' => $request->biaya_bulan,
                'bpf' => $request->bpf,
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
    public function update(Request $request, string $id_pphuni)
    {
        //
        $pphunifikasi=Pphunifikasi::where('id_pphuni',$id_pphuni)->update([
            'ntpn' => (int)$request->ntpn,
            'jumlah_bayar' => (int)$request->jumlah_bayar,
            'biaya_bulan' => (int)$request->biaya_bulan,
            'bpf' => (string)$request->bpf,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
