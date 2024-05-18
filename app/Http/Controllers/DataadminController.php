<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DataadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataadmins = User::all();
        return view('dataadmin', compact('dataadmins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dataadmin');
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {

        // dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:5|max:255|confirmed',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('dataadmin')->with('success', 'Registration successful! Please login');
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $dataadmin = User::find($id);
        // return view('edit_form', compact('dataadmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataadmin = User::findOrFail($id);
    
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users,email,' . $dataadmin->id,
            'password' => 'nullable|min:5|max:255|confirmed',
            'role' => 'required',
        ]);
    
        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
    
        $dataadmin->update($validatedData);
    
        return redirect()->route('dataadmin')->with('success', 'User updated successfully');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted = User::where('id', $id)->delete();
        return redirect('dataadmin');
    }
    
}