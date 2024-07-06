<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pajak;

class UserController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::guard('user')->user();
    
        // Ambil data pajak sesuai dengan user yang sedang login
        $pajak = Pajak::join('jenis', 'jenis.id_pajak', '=', 'pajaks.id_pajak')
            ->join('statuses', 'statuses.id_pajak', '=', 'pajaks.id_pajak')
            ->where('pajaks.id', $user->id)
            ->first();
    
        
        return view('user.profiluser', compact('pajak'));
    }
    
}


            
