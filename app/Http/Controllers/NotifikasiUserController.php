<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreNotifikasiUserRequest;
use App\Http\Requests\UpdateNotifikasiUserRequest;

class NotifikasiUserController extends Controller
{

    public function index()
    {
        $cart = Session::get('cart', []);
        $profile = null;
        $user = Auth::user();

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = Notifikasiuser::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        // Kirim notifikasi ke view
        return view('studen.notifikasi.index', compact('notifikasi', 'cart', 'profile', 'user'));
    }
    public function getNotifications()
    {
        $user = Auth::user();
        $notifikasi = [];

        if ($user) {
            $notifikasi = Notifikasiuser::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('layout.partials.notifications', compact('notifikasi'));
    }
}
