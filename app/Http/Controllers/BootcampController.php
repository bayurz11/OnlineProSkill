<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\AdminEvent;
use App\Models\Categories;
use App\Models\Sertifikat;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BootcampController extends Controller
{
    public function index()
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $daftar_siswa = UserProfile::where('role_id', 3)->get();
        $sertifikat = Sertifikat::all();

        // Mengambil KelasTatapMuka dan mengurutkannya berdasarkan kolom created_at
        $KelasTatapMuka = KelasTatapMuka::orderBy('created_at', 'asc')->get();
        $blog = Blog::orderBy('created_at', 'desc')->take(4)->get();

        // Mengambil event dan memfilter yang tanggalnya belum lewat, lalu membatasi 3 terbaru
        $event = AdminEvent::where('tgl', '>=', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

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

        return view('bootcamp.index', compact('user', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'categori', 'KelasTatapMuka', 'event', 'blog', 'daftar_siswa', 'sertifikat'));
    }

    public function addToCartceckout($id)
    {
        $course = KelasTatapMuka::find($id);
        $cart = Session::get('cart', []);

        if (!isset($cart[$id])) {
            $cart[$id] = [
                "id" => $id,
                "name" => $course->nama_kursus,
                "price" => $course->price,
                "gambar" => $course->gambar,
                "quantity" => 1,
            ];

            Session::flash('success', 'Item telah ditambahkan ke keranjang!');
        } else {
            Session::flash('info', 'Item sudah ada di keranjang!');
        }

        Session::put('cart', $cart);

        return redirect()->route('cart_bootcamp.view');
    }
    public function show()
    {
        $categori = Categories::all();
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $courses = KelasTatapMuka::whereIn('id', array_column($cart, 'id'))->get();

        if ($courses->isEmpty() && !empty($cart)) {
            return redirect()->route('cart_bootcamp.view')->with('info', 'Kelas tidak ditemukan.');
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        return view('home.bootcamp_cart', compact('user', 'categori', 'cart', 'profile', 'courses', 'notifikasiCount', 'notifikasi'));
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);

        return redirect()->route('pbi');
    }
}
