<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InstrukturCoursesController extends Controller
{
    public function index()
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }
        // Mengambil profil pengguna yang sedang login
        $profile = UserProfile::where('user_id', $user->id)->first();
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Ambil KelasTatapMuka berdasarkan user_id pengguna yang sedang login
        $KelasTatapMuka = KelasTatapMuka::where('user_id', $user->id)->get();

        $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->pluck('total', 'product_id');

        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();

        return view('instruktur.MyCourses.courses', compact(
            'user',
            'KelasTatapMuka',
            'categori',
            'profile',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'orders',
            'jumlahPendaftaran'
        ));
    }


    public function store(Request $request)
    {
        // Mendapatkan ID pengguna yang sedang masuk
        $userId = Auth::id();

        // Proses unggahan gambar
        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);
        }

        // Hitung harga setelah diskon jika ada
        $hargaSetelahDiskon = null;
        if ($request->filled('price') && $request->filled('discount')) {
            $hargaSetelahDiskon = $request->price - ($request->price * ($request->discount / 100));
        }

        // Buat entitas kursus baru
        $course = new KelasTatapMuka();
        $course->nama_kursus = $request->nama_kursus;
        $course->kategori_id = $request->kategori_id;
        $course->subkategori_id = $request->subkategori_id;
        $course->content = $request->content;
        $course->tingkat = $request->tingkat;
        $course->include = json_encode($request->include);
        $course->perstaratan = json_encode($request->perstaratan);
        $course->price = $request->filled('price') ? $request->price : null;
        $course->discount = $request->filled('discount') ? $request->discount : null;
        $course->discountedPrice = $hargaSetelahDiskon; // Simpan harga setelah diskon
        $course->gambar = $gambarName;
        $course->tag = $request->tag;
        $course->durasi = $request->durasi;
        $course->sertifikat = $request->sertifikat;
        $course->kuota = $request->kuota;
        $course->user_id = $userId;
        $course->course_type = $request->course_type;

        // Simpan data kursus ke database
        $course->save();

        return redirect()->route('instruktur_courses')->with('success', 'Kursus berhasil disimpan.');
    }
}
