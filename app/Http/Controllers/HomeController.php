<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Order;
use App\Models\Reviews;
use App\Models\Section;
use App\Models\Kurikulum;
use App\Models\AdminEvent;
use App\Models\Categories;
use App\Models\Sertifikat;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $cart = Session::get('cart', []);
        $categori = Categories::all();

        // Mengambil daftar course_type unik dari KelasTatapMuka, kecuali 'bootcamp' dan 'produk'
        $courseTypes = KelasTatapMuka::distinct()
            ->whereNotIn('course_type', ['bootcamp', 'produk'])
            ->pluck('course_type');

        // Mengambil KelasTatapMuka yang aktif dengan filter berdasarkan status dan mengabaikan 'bootcamp' dan 'produk'
        // $KelasTatapMuka = KelasTatapMuka::where('status', 1)
        //     // ->whereNotIn('course_type', ['bootcamp', 'produk'])
        //     ->orderBy('created_at', 'asc')
        //     ->get();

        $KelasTatapMuka = KelasTatapMuka::where('status', 1)
            ->where(function ($query) {
                $query->where('course_type', '!=', 'bootcamp')
                    ->orWhere('status', 1);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        // Data tambahan
        $blog = Blog::latest()->take(4)->get();
        $event = AdminEvent::where('tgl', '>=', Carbon::now())->latest()->take(3)->get();
        $daftar_siswa = UserProfile::where('role_id', 3)->get();
        // $sertifikat = Sertifikat::whereIn('kategori_id', [18, 19, 20, 21])->get();
        $sertifikat = Sertifikat::all();

        // Notifikasi
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)->latest()->get() : collect();
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Joined courses
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

        return view('home.index', compact(
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


    public function classroom()
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Tambahkan kondisi untuk filter course_type = offline
        $course = KelasTatapMuka::with('user')
            ->where('status', 1)
            ->where('course_type', 'offline')
            ->get();
        // Filter kursus berdasarkan apakah course_id ada di model Kurikulum
        $course = $course->filter(function ($kelas) {
            return Kurikulum::where('course_id', $kelas->id)->exists();
        });
        $count = $course->count();


        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Ambil jumlah pendaftaran untuk setiap kursus
        $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->pluck('total', 'product_id');

        // Ambil ID kursus yang telah diikuti oleh user
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

        return view('home.classroom', compact('user', 'categori', 'count', 'course', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'jumlahPendaftaran', 'joinedCourses'));
    }

    public function classroomdetail($id)
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $courses = KelasTatapMuka::find($id);

        if (!$courses) {
            abort(404, 'Kelas tatap muka tidak ditemukan.');
        }

        $courseList = json_decode($courses->include, true);

        if (!is_array($courseList)) {
            $courseList = [];
        }
        $perstaratan = json_decode($courses->perstaratan, true);

        if (!is_array($perstaratan)) {
            $perstaratan = [];
        }

        $fasilitas = json_decode($courses->fasilitas, true);

        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $notifikasiCount = $notifikasi->where('status', 1)->count();
        $jumlahPendaftaran = Order::where('product_id', $id)->count();

        $section = Section::whereIn('kurikulum_id', $kurikulum->pluck('id'))->get()->groupBy('kurikulum_id');

        $joinedCourses = $user
            ? Order::where('user_id', $user->id)
            ->whereIn('status', ['paid', 'settled'])
            ->pluck('product_id')
            ->toArray()
            : [];

        $userHasAccess = in_array($id, $joinedCourses);

        $orderProductIds = Order::where('product_id', $id)->pluck('product_id');
        $sertifikatCount = Sertifikat::whereIn('kategori_id', $orderProductIds)->count();

        $reviews = Reviews::where('class_id', $id)->with('user', 'kelasTatapMuka')->get();

        return view('home.classroomdetail', compact(
            'user',
            'reviews',
            'categori',
            'jumlahPendaftaran',
            'courses',
            'kurikulum',
            'courseList',
            'perstaratan',
            'profile',
            'cart',
            'notifikasiCount',
            'notifikasi',
            'section',
            'joinedCourses',
            'sertifikatCount',
            'userHasAccess'
        ));
    }

    public function course()
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Tambahkan kondisi untuk filter course_type = online
        $course = KelasTatapMuka::with('user')
            ->where('status', 1)
            ->where('course_type', 'online')
            ->get();

        // Filter kursus berdasarkan apakah course_id ada di model Kurikulum
        $course = $course->filter(function ($kelas) {
            return Kurikulum::where('course_id', $kelas->id)->exists();
        });
        $count = $course->count();


        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Ambil jumlah pendaftaran untuk setiap kursus
        $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->pluck('total', 'product_id');

        // Ambil ID kursus yang telah diikuti oleh user
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

        return view('home.course', compact('user', 'categori', 'count', 'course', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'jumlahPendaftaran', 'joinedCourses'));
    }

    public function coursedetail($id)
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $courses = KelasTatapMuka::find($id);

        if (!$courses) {
            abort(404, 'Kelas tatap muka tidak ditemukan.');
        }

        $courseList = json_decode($courses->include, true);

        if (!is_array($courseList)) {
            $courseList = [];
        }
        $perstaratan = json_decode($courses->perstaratan, true);

        if (!is_array($perstaratan)) {
            $perstaratan = [];
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

        $joinedCourses = $user
            ? Order::where('user_id', $user->id)
            ->whereIn('status', ['paid', 'settled']) // Memeriksa status
            ->pluck('product_id')
            ->toArray()
            : [];


        // Ambil sertifikat dan hitung jumlah kategori_id sesuai dengan id dari product_id
        $orderProductIds = Order::where('product_id', $id)->pluck('product_id');
        $sertifikatCount = Sertifikat::whereIn('kategori_id', $orderProductIds)->count();

        return view('home.coursedetail', compact('user', 'categori', 'jumlahPendaftaran', 'courses', 'kurikulum', 'courseList', 'perstaratan', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'section', 'joinedCourses', 'sertifikatCount'));
    }

    public function checkout(Request $request, $id)
    {
        $categori = Categories::all();
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

        return view('home.checkout', compact('user', 'categori', 'profile', 'courses', 'cart', 'notifikasiCount', 'notifikasi'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->withInput();
        }

        // Update password user
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('/')->with('success', 'Password berhasil diperbarui. Silakan login.');
    }
}
