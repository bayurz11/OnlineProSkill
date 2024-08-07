<?php

namespace App\Http\Controllers;

use App\Models\AdminEvent;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function index()
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);

        // Mengambil event dan memfilter yang tanggalnya belum lewat, serta melakukan paginasi
        $event = AdminEvent::where('tgl', '>=', Carbon::now())->orderBy('created_at', 'desc')->paginate(4);

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        return view('home.event.index', compact('user', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'categori', 'event'));
    }

    public function detailEvent($id)
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $event = AdminEvent::find($id);
        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        return view('home.event.detail', compact('user', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'categori', 'event'));
    }
}
