<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Pajak;
use App\Models\Pph;
use App\Models\Pph21;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        $totalpembayar = Pajak::count();
        $jumlahkaryawan = Karyawan::count();
        $totalbayarpph = Pph::sum('jumlah_bayar');
        $totalbayarpph21 = Pph21::sum('jumlah_bayar');

        return view('user.beranda', [
            'totalpembayar' => $totalpembayar,
            'jumlahkaryawan' => $jumlahkaryawan,
            'totalbayarpph' => $totalbayarpph,
            'totalbayarpph21' => $totalbayarpph21
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.user-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nama_wp', 'npwp');

        $pajak = Pajak::where('nama_wp', $credentials['nama_wp'])
                      ->where('npwp', $credentials['npwp'])
                      ->first();

        if ($pajak) {
            Auth::guard('user')->login($pajak);
            return redirect()->intended('/user/beranda');
        } else {
            return redirect()->back()->withInput()->withErrors(['nama_wp' => 'Nama WP atau NPWP salah.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}
