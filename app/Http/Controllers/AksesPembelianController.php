<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AksesPembelianController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();

        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $notifikasiCount = $notifikasi->where('status', 1)->count();
        return view('studen.aksespembelian', compact('user', 'profile', 'cart', 'notifikasi', 'notifikasiCount'));
    }
}
