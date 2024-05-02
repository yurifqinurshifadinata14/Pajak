<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status=Status::all();
        return view('status.status', compact('status'));
        // return view('status.status');
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
        // $status = $request->validate([
        //     'status' => 'required|string',
        //     'enofaPassword' => 'nullable|string'
        // ]);

        Status::create([
            'status' => $request->status,
            'enofaPassword' => $request->enofaPassword,
            'passphrasePassword' => $request->passphrasePassword,
            'userEfaktur' => $request->userEfaktur,
            'passwordEfaktur' => $request->passwordEfaktur,
        ]);
            
        return redirect()->route('statusSub');
    }

    public function statussub()
    {
        $status = Status::all();
        return view('status.statussub', compact('status'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
        $status = Status::find($status);
        return view('status.statused',compact('statussub'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        //
        Status::where('id', $status)->update([

        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        //
    }
}