<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create([
            'name' => $request->name,   
            'email' => $request->email,
            'password' => $request->password,
            'role' => "staff",
        ]);

        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }


    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Get user role
        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'staff') {
            return redirect()->intended('/beranda');
        }

        return redirect()->intended('/user/beranda');
    }

    return back()->with('loginError', 'Login Failed!');
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
