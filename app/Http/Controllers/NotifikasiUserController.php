<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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
        $notifikasi = NotifikasiUser::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        // Hitung jumlah notifikasi
        $notifikasiCount = $notifikasi->count();

        // Kirim notifikasi dan jumlah notifikasi ke view
        return view('studen.notifikasi.index', compact('notifikasi', 'cart', 'profile', 'user', 'notifikasiCount', 'notifikasi'));
    }

    public function getNotifications()
    {
        $user = Auth::user();
        $notifikasi = [];

        if ($user) {
            $notifikasi = NotifikasiUser::where('user_id', $user->id)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('layout.partials.notifications', compact('notifikasi'));
    }


    public function bacaSemua(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            NotifikasiUser::where('user_id', $user->id)->update(['status' => 0]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Semua notifikasi telah dibaca.',
            'timestamp' => now()->toDateTimeString()
        ]);
    }
}
