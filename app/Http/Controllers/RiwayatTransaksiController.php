<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
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

        return view('studen.history', compact('user', 'profile', 'cart'));
    }
}
