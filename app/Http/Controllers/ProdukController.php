<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Reviews;
use App\Models\Kurikulum;
use App\Models\AdminEvent;
use App\Models\Categories;
use App\Models\Sertifikat;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $categori = Categories::all();
        $category_ids = $request->input('categories', []);
        $priceFilter = $request->input('price', []); // Default is an empty array if no filter
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;

        // Ambil semua tingkat dari kursus dengan course_type 'produk'
        $tingkatLevels = KelasTatapMuka::where('course_type', 'produk')
            ->distinct()
            ->pluck('tingkat');

        // Ambil semua course_id yang ada di model Kurikulum
        $kurikulumCourseIds = Kurikulum::pluck('course_id')->toArray();
        // Pastikan category_ids adalah array
        if (!is_array($category_ids)) {
            $category_ids = explode(',', $category_ids);
        }
        $category_ids = array_filter($category_ids);
        // Menghitung jumlah kursus per kategori yang ada di Kurikulum
        $categoryCounts = KelasTatapMuka::select('kategori_id', DB::raw('count(*) as total'))
            ->where('status', 1)
            ->where('course_type', 'produk')
            ->whereIn('id', $kurikulumCourseIds)
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        // Menghitung jumlah kursus per tingkat yang ada di Kurikulum
        $tingkatCounts = KelasTatapMuka::select('tingkat', DB::raw('count(*) as total'))
            ->where('status', 1)
            ->where('course_type', 'produk')
            ->whereIn('id', $kurikulumCourseIds)
            ->groupBy('tingkat')
            ->pluck('total', 'tingkat');

        // Hitung jumlah rating untuk setiap kursus
        $ratingCounts = Reviews::select('class_id', DB::raw('count(*) as total'))
            ->groupBy('class_id')
            ->pluck('total', 'class_id');

        // Menambahkan logika pencarian berdasarkan orderby
        $orderby = $request->input('orderby', 'latest'); // Default ke 'latest'

        $results = KelasTatapMuka::query()
            ->where('status', 1)
            ->where('course_type', 'produk')
            ->whereIn('id', $kurikulumCourseIds);

        // Apply price filter
        if (in_array('free', $priceFilter)) {
            $results->where('price', 0); // Free courses
        } elseif (in_array('paid', $priceFilter)) {
            $results->where('price', '>', 0); // Paid courses
        }

        // Apply other filters like orderby
        switch ($orderby) {
            case 'oldest':
                $results->orderBy('created_at', 'asc'); // Terlama
                break;
            case 'highest_price':
                $results->orderBy('price', 'desc'); // Harga tertinggi
                break;
            case 'lowest_price':
                $results->orderBy('price', 'asc'); // Harga terendah
                break;
            case 'latest':
            default:
                $results->orderBy('created_at', 'desc'); // Terbaru
                break;
        }

        $results = $results->paginate(6);


        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get() : collect();

        $course = KelasTatapMuka::with('user')
            ->where('status', 1)
            ->where('course_type', 'produk')
            ->get();
        $count = $course->count();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Ambil jumlah pendaftaran untuk setiap kursus
        $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->pluck('total', 'product_id');

        // Ambil ID kursus yang telah diikuti oleh user
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

        return view('home.produk.index', compact(
            'results',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'user',
            'profile',
            'jumlahPendaftaran',
            'joinedCourses',
            'course',
            'categoryCounts',
            'tingkatLevels',
            'tingkatCounts',
            'categori',
            'ratingCounts',
            'category_ids'
        ))->with('paginationView', 'vendor.custom');
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
