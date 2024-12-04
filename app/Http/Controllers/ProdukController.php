<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
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

        // Menangkap filter harga dari request
        $priceFilter = $request->input('price', []);

        // Ambil query dasar untuk hasil kursus
        $results = KelasTatapMuka::query()
            ->where('status', 1)
            ->where('course_type', 'produk')
            ->when(!empty($category_ids), function ($query) use ($category_ids) {
                return $query->whereIn('kategori_id', $category_ids);
            })
            ->when($orderby, function ($query, $orderby) {
                if ($orderby == 'latest') {
                    return $query->orderBy('created_at', 'desc');
                } elseif ($orderby == 'oldest') {
                    return $query->orderBy('created_at', 'asc');
                } elseif ($orderby == 'highest_price') {
                    return $query->orderBy('price', 'desc');
                } elseif ($orderby == 'lowest_price') {
                    return $query->orderBy('price', 'asc');
                }
            })
            // Filter berdasarkan harga
            ->when($priceFilter, function ($query) use ($priceFilter) {
                // Jika priceFilter kosong, anggap sebagai 'free'
                if (empty($priceFilter)) {
                    return $query->where('price', 0);  // Harga 0 dianggap Free
                }

                // Jika ada 'paid' dalam filter, cari yang harga > 0
                if (in_array('paid', $priceFilter)) {
                    return $query->where('price', '>', 0);
                }

                // Jika ada 'free' dalam filter, cari yang harga = 0
                if (in_array('free', $priceFilter)) {
                    return $query->where('price', 0);
                }
            })
            ->whereIn('id', $kurikulumCourseIds)
            ->paginate(6);


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






    public function detail($id)
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();
        // Ambil semua course_id yang ada di model Kurikulum
        $kurikulumCourseIds = Kurikulum::pluck('course_id')->toArray();

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $courses = KelasTatapMuka::find($id);

        if (!$courses) {
            abort(404, 'produk tidak ditemukan.');
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

        // Memastikan query ini mengembalikan data dengan filter yang tepat
        $results = KelasTatapMuka::query()
            ->where('status', 1)
            ->where('course_type', 'produk') // pastikan ada nilai 'produk' pada kolom 'course_type'
            ->whereIn('id', $kurikulumCourseIds) // Filter dengan course_id dari kurikulum
            ->get(); // Menggunakan get() untuk mengeksekusi query

        // Ambil sertifikat dan hitung jumlah kategori_id sesuai dengan id dari product_id
        $orderProductIds = Order::where('product_id', $id)->pluck('product_id');
        $sertifikatCount = Sertifikat::whereIn('kategori_id', $orderProductIds)->count();
        $reviews = Reviews::where('class_id', $id)->with('user', 'kelasTatapMuka')->get();

        return view('home.produk.detail', compact(
            'user',
            'results',
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
            'sertifikatCount'
        ));
    }
}
