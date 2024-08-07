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

class SearchController extends Controller
{
    // public function search(Request $request)
    // {
    //     $user = Auth::user();
    //     $cart = Session::get('cart', []);
    //     $categori = Categories::all();
    //     $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
    //     $category_ids = $request->input('categories', []);

    //     // Pastikan category_ids adalah array
    //     if (!is_array($category_ids)) {
    //         $category_ids = explode(',', $category_ids);
    //     }
    //     $category_ids = array_filter($category_ids); // Hapus elemen kosong

    //     $search_term = $request->input('search_term');

    //     // Mencari berdasarkan kategori dan term pencarian
    //     $results = KelasTatapMuka::query()
    //         ->when(!empty($category_ids), function ($query) use ($category_ids) {
    //             return $query->whereIn('kategori_id', $category_ids);
    //         })
    //         ->when($search_term, function ($query, $search_term) {
    //             return $query->where('nama_kursus', 'like', '%' . $search_term . '%');
    //         })
    //         ->get();

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
    //         ->groupBy('kategori_id')
    //         ->pluck('total', 'kategori_id');

    //     return view('search_results', compact('results', 'categori', 'cart', 'notifikasi', 'notifikasiCount', 'user', 'profile', 'jumlahPendaftaran', 'joinedCourses', 'course', 'categoryCounts', 'category_ids'));
    // }220724

    public function search(Request $request)
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $categori = Categories::all();
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $category_ids = $request->input('categories', []);
        $tingkatLevels = KelasTatapMuka::distinct()->pluck('tingkat');

        // Menghitung jumlah kursus per tingkat
        $tingkatCounts = KelasTatapMuka::select('tingkat', DB::raw('count(*) as total'))
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

        // Mencari berdasarkan kategori, tingkat, dan term pencarian
        $results = KelasTatapMuka::query()
            ->when(!empty($category_ids), function ($query) use ($category_ids) {
                return $query->whereIn('kategori_id', $category_ids);
            })
            ->when($search_term, function ($query, $search_term) {
                return $query->where('nama_kursus', 'like', '%' . $search_term . '%');
            })
            ->when(!empty($selectedTingkat), function ($query) use ($selectedTingkat) {
                return $query->whereIn('tingkat', $selectedTingkat);
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
            ->get();

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $course = KelasTatapMuka::with('user')
            ->where('status', 1)
            ->where('course_type', 'offline')
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
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        return view('search_results', compact('results', 'cart', 'notifikasi', 'notifikasiCount', 'user', 'profile', 'jumlahPendaftaran', 'joinedCourses', 'course', 'categoryCounts', 'category_ids', 'tingkatLevels', 'tingkatCounts', 'categori'));
    }
}
