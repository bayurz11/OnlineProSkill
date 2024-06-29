<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RiwayatTransaksiController extends Controller
{
    public function index()
    {

        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }
        $profile = UserProfile::where('user_id', $user->id)->first();
        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = NotifikasiUser::all();
        return view('studen.history', compact('user', 'profile', 'cart', 'notifikasi'));
    }
}
