<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Section;
use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);

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

        return view('home.index', compact('user', 'profile', 'cart', 'notifikasiCount', 'notifikasi'));
    }

    public function classroom()
    {
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $course = KelasTatapMuka::with('user')->where('status', 1)->get();
        $count = $course->count();

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->pluck('total', 'product_id');
        return view('home.classroom', compact('user', 'count', 'course', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'jumlahPendaftaran'));
    }

    // public function classroomdetail($id, $slug)
    // {
    //     $user = Auth::user();
    //     $profile = null;
    //     $cart = Session::get('cart', []);
    //     $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();
    //     if ($user) {
    //         $profile = UserProfile::where('user_id', $user->id)->first();
    //     }

    //     $courses = KelasTatapMuka::find($slug);

    //     if (!$courses) {
    //         abort(404, 'Kelas tatap muka tidak ditemukan.');
    //     }

    //     $courseList = json_decode($courses->include, true);

    //     if (!is_array($courseList)) {
    //         $courseList = [];
    //     }

    //     $fasilitas = json_decode($courses->fasilitas, true);

    //     // Ambil notifikasi untuk pengguna yang sedang login
    //     $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

    //     // Hitung jumlah notifikasi dengan status = 1
    //     $notifikasiCount = $notifikasi->where('status', 1)->count();
    //     $jumlahPendaftaran = Order::where('product_id', $id)->count();

    //     // Ambil section yang relevan dengan kurikulum
    //     $section = Section::whereIn('kurikulum_id', $kurikulum->pluck('id'))->get()->groupBy('kurikulum_id');

    //     return view('home.classroomdetail', compact('user', 'jumlahPendaftaran', 'courses', 'kurikulum', 'courseList', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'section'));
    // }
    public function classroomdetail($id, $slug)
    {
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $courses = KelasTatapMuka::where('id', $id)->where('slug', $slug)->first();

        if (!$courses) {
            abort(404, 'Kelas tatap muka tidak ditemukan.');
        }

        $courseList = json_decode($courses->include, true);

        if (!is_array($courseList)) {
            $courseList = [];
        }

        $fasilitas = json_decode($courses->fasilitas, true);

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        $jumlahPendaftaran = Order::where('product_id', $id)->count();

        // Ambil section yang relevan dengan kurikulum
        $section = Section::whereIn('kurikulum_id', $kurikulum->pluck('id'))->get()->groupBy('kurikulum_id');

        return view('home.classroomdetail', compact('user', 'jumlahPendaftaran', 'courses', 'kurikulum', 'courseList', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'section'));
    }




    public function checkout(Request $request, $id)
    {
        $user = Auth::user();
        $profile = null;

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $cart = json_decode($request->input('cart'), true);

        if (!$cart) {
            return redirect()->route('/')->with('error', 'Keranjang belanja kosong.');
        }

        $courses = KelasTatapMuka::whereIn('id', array_column($cart, 'id'))->get();

        if ($courses->isEmpty()) {
            return redirect()->route('/')->with('error', 'Kelas tidak ditemukan.');
        }

        $cart = Session::get('cart', []);

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        return view('home.checkout', compact('user', 'profile', 'courses', 'cart', 'notifikasiCount', 'notifikasi'));
    }

    // public function checkout($id)
    // {
    //     $courses = KelasTatapMuka::find($id);

    //     if (!$courses) {
    //         abort(404, 'Kelas tatap muka tidak ditemukan.');
    //     }
    //     $user = Auth::user();
    //     $profile = null;

    //     if ($user) {
    //         $profile = UserProfile::where('user_id', $user->id)->first();
    //     }

    //     return view('home.checkout', compact('user', 'profile', 'courses'));
    // }
}
