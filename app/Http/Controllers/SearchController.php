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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{

    // public function search(Request $request)
    // {
    //     $user = Auth::user();
    //     $cart = Session::get('cart', []);
    //     $categori = Categories::all();
    //     $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
    //     $category_ids = $request->input('categories', []);
    //     $tingkatLevels = KelasTatapMuka::distinct()->pluck('tingkat');

    //     // Menghitung jumlah kursus per tingkat
    //     $tingkatCounts = KelasTatapMuka::select('tingkat', DB::raw('count(*) as total'))
    //         ->where('status', 1)
    //         ->groupBy('tingkat')
    //         ->pluck('total', 'tingkat');

    //     // Pastikan category_ids adalah array
    //     if (!is_array($category_ids)) {
    //         $category_ids = explode(',', $category_ids);
    //     }
    //     $category_ids = array_filter($category_ids); // Hapus elemen kosong

    //     $search_term = $request->input('search_term');
    //     $orderby = $request->input('orderby', 'latest'); // Default ke 'latest' jika tidak ada input
    //     $selectedTingkat = $request->input('tingkat', []);

    //     // Pastikan selectedTingkat adalah array
    //     if (!is_array($selectedTingkat)) {
    //         $selectedTingkat = explode(',', $selectedTingkat);
    //     }
    //     $selectedTingkat = array_filter($selectedTingkat); // Hapus elemen kosong

    //     // Mencari berdasarkan kategori, tingkat, dan term pencarian dengan pagination
    //     $results = KelasTatapMuka::query()
    //         ->where('status', 1)
    //         ->when(!empty($category_ids), function ($query) use ($category_ids) {
    //             return $query->whereIn('kategori_id', $category_ids);
    //         })
    //         ->when($search_term, function ($query, $search_term) {
    //             return $query->where('nama_kursus', 'like', '%' . $search_term . '%');
    //         })
    //         ->when(!empty($selectedTingkat), function ($query) use ($selectedTingkat) {
    //             return $query->whereIn('tingkat', $selectedTingkat);
    //         })
    //         ->when($orderby, function ($query, $orderby) {
    //             if ($orderby == 'latest') {
    //                 return $query->orderBy('created_at', 'desc');
    //             } elseif ($orderby == 'oldest') {
    //                 return $query->orderBy('created_at', 'asc');
    //             } elseif ($orderby == 'highest_price') {
    //                 return $query->orderBy('price', 'desc');
    //             } elseif ($orderby == 'lowest_price') {
    //                 return $query->orderBy('price', 'asc');
    //             }
    //         })
    //         ->paginate(6); // Change this line to use pagination, set 10 items per page

    //     // Ambil notifikasi untuk pengguna yang sedang login
    //     $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         : collect();

    //     $course = KelasTatapMuka::with('user')
    //         ->where('status', 1)
    //         ->where('course_type', 'offline')
    //         ->get();
    //     $count = $course->count();
    //     // Hitung jumlah notifikasi dengan status = 1
    //     $notifikasiCount = $notifikasi->where('status', 1)->count();

    //     // Ambil jumlah pendaftaran untuk setiap kursus
    //     $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
    //         ->groupBy('product_id')
    //         ->pluck('total', 'product_id');

    //     // Ambil ID kursus yang telah diikuti oleh user
    //     $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

    //     // Hitung jumlah kursus per kategori
    //     $categoryCounts = KelasTatapMuka::select('kategori_id', DB::raw('count(*) as total'))
    //         ->where('status', 1)
    //         ->groupBy('kategori_id')
    //         ->pluck('total', 'kategori_id');

    //     return view('search_results', compact('results', 'cart', 'notifikasi', 'notifikasiCount', 'user', 'profile', 'jumlahPendaftaran', 'joinedCourses', 'course', 'categoryCounts', 'category_ids', 'tingkatLevels', 'tingkatCounts', 'categori'))->with('paginationView', 'vendor.custom');
    // }
    public function search(Request $request)
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);
        // Menggunakan eager loading untuk memuat relasi kelastatapmuka
        $categori = Categories::with(['kelastatapmuka' => function ($query) {
            $query->where('course_type', '!=', 'bootcamp'); // Mengecualikan course_type bootcamp
        }])->get();

        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $category_ids = $request->input('categories', []);
        $tingkatLevels = KelasTatapMuka::distinct()->pluck('tingkat');

        // Menghitung jumlah kursus per tingkat
        $tingkatCounts = KelasTatapMuka::select('tingkat', DB::raw('count(*) as total'))
            ->where('status', 1)
            ->groupBy('tingkat')
            ->pluck('total', 'tingkat');

        // Pastikan category_ids adalah array
        if (!is_array($category_ids)) {
            $category_ids = explode(',', $category_ids);
        }
        $category_ids = array_filter($category_ids); // Hapus elemen kosong

        $search_term = $request->input('search_term');
        $orderby = $request->input('orderby', 'latest'); // Default ke 'latest' jika tidak ada input
        $selectedTingkat = $request->input('tingkat', []);

        // Pastikan selectedTingkat adalah array
        if (!is_array($selectedTingkat)) {
            $selectedTingkat = explode(',', $selectedTingkat);
        }
        $selectedTingkat = array_filter($selectedTingkat); // Hapus elemen kosong

        // Dapatkan course_type dari request
        $courseType = $request->input('course_type', []); // Ambil 'offline' atau 'online'
        if (!is_array($courseType)) {
            $courseType = explode(',', $courseType);
        }
        $courseType = array_filter($courseType); // Hapus elemen kosong

        // Mencari berdasarkan kategori, tingkat, course_type, dan term pencarian dengan pagination
        $results = KelasTatapMuka::query()
            ->where('status', 1)
            ->whereNotIn('course_type', ['bootcamp']) // Mengecualikan 'bootcamp'
            ->when(!empty($category_ids), function ($query) use ($category_ids) {
                return $query->whereIn('kategori_id', $category_ids);
            })
            ->when($search_term, function ($query, $search_term) {
                return $query->where('nama_kursus', 'like', '%' . $search_term . '%');
            })
            ->when(!empty($selectedTingkat), function ($query) use ($selectedTingkat) {
                return $query->whereIn('tingkat', $selectedTingkat);
            })
            ->when(!empty($courseType), function ($query) use ($courseType) {
                return $query->whereIn('course_type', $courseType);
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
            ->paginate(6); // Gunakan pagination, 6 item per halaman

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $course = KelasTatapMuka::with('user')
            ->where('status', 1)
            ->whereIn('course_type', ['offline', 'online']) // Menampilkan 'offline' dan 'online' saja
            ->whereNotIn('course_type', ['bootcamp']) // Mengecualikan 'bootcamp'
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

        // Hitung jumlah kursus per kategori
        $categoryCounts = KelasTatapMuka::select('kategori_id', DB::raw('count(*) as total'))
            ->where('status', 1)
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        // Akses data course_type dari relasi KelasTatapMuka melalui Categories tanpa course_type 'bootcamp'
        foreach ($categori as $category) {
            // Pastikan kelastatapmuka bukan null
            if ($category->kelastatapmuka) {
                foreach ($category->kelastatapmuka as $kelas) {
                    // Anda bisa melakukan sesuatu dengan $kelas->course_type
                    echo $kelas->course_type;
                }
            }
        }

        return view('search_results', compact('results', 'cart', 'notifikasi', 'notifikasiCount', 'user', 'profile', 'jumlahPendaftaran', 'joinedCourses', 'course', 'categoryCounts', 'category_ids', 'tingkatLevels', 'tingkatCounts', 'categori'))->with('paginationView', 'vendor.custom');
    }
}
