<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Order;
use App\Models\AdminEvent;
use App\Models\Categories;
use App\Models\Sertifikat;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $cart = Session::get('cart', []);
        $categori = Categories::all();

        // Mengambil daftar course_type unik dari KelasTatapMuka, kecuali 'bootcamp'
        $courseTypes = KelasTatapMuka::distinct()
            ->where('course_type', '!=', 'bootcamp')
            ->pluck('course_type');

        // Mengambil KelasTatapMuka yang aktif dengan filter berdasarkan status dan mengabaikan 'bootcamp'
        $KelasTatapMuka = KelasTatapMuka::where('status', 1)
            ->where('course_type', '!=', 'bootcamp')
            ->orderBy('created_at', 'asc')
            ->get();

        // Data tambahan
        $blog = Blog::latest()->take(4)->get();
        $event = AdminEvent::where('tgl', '>=', Carbon::now())->latest()->take(3)->get();
        $daftar_siswa = UserProfile::where('role_id', 3)->get();
        $sertifikat = Sertifikat::whereIn('kategori_id', [13, 14])->get();

        // Notifikasi
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)->latest()->get() : collect();
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Joined courses
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

        return view('home.produk.index', compact(
            'user',
            'profile',
            'joinedCourses',
            'cart',
            'notifikasiCount',
            'notifikasi',
            'categori',
            'KelasTatapMuka',
            'event',
            'blog',
            'daftar_siswa',
            'sertifikat',
            'courseTypes'
        ));
    }
    public function detail()
    {
        $user = Auth::user();
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $cart = Session::get('cart', []);
        $categori = Categories::all();

        // Mengambil daftar course_type unik dari KelasTatapMuka, kecuali 'bootcamp'
        $courseTypes = KelasTatapMuka::distinct()
            ->where('course_type', '!=', 'bootcamp')
            ->pluck('course_type');

        // Mengambil KelasTatapMuka yang aktif dengan filter berdasarkan status dan mengabaikan 'bootcamp'
        $KelasTatapMuka = KelasTatapMuka::where('status', 1)
            ->where('course_type', '!=', 'bootcamp')
            ->orderBy('created_at', 'asc')
            ->get();

        // Data tambahan
        $blog = Blog::latest()->take(4)->get();
        $event = AdminEvent::where('tgl', '>=', Carbon::now())->latest()->take(3)->get();
        $daftar_siswa = UserProfile::where('role_id', 3)->get();
        $sertifikat = Sertifikat::whereIn('kategori_id', [13, 14])->get();

        // Notifikasi
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)->latest()->get() : collect();
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Joined courses
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

        return view('home.produk.detail', compact(
            'user',
            'profile',
            'joinedCourses',
            'cart',
            'notifikasiCount',
            'notifikasi',
            'categori',
            'KelasTatapMuka',
            'event',
            'blog',
            'daftar_siswa',
            'sertifikat',
            'courseTypes'
        ));
    }
}
