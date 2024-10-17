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

    public function search(Request $request)
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $categori = Categories::all();
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;

        // Ambil data input dari request
        $category_ids = $request->input('categories', []);
        $search_term = $request->input('search_term');
        $orderby = $request->input('orderby', 'latest');
        $selectedTingkat = $request->input('tingkat', []);
        $course_type = $request->input('course_type', ['online', 'offline']); // Default untuk online dan offline

        // Ubah menjadi array jika bukan array
        $category_ids = is_array($category_ids) ? array_filter($category_ids) : explode(',', $category_ids);
        $selectedTingkat = is_array($selectedTingkat) ? array_filter($selectedTingkat) : explode(',', $selectedTingkat);
        $course_type = is_array($course_type) ? array_filter($course_type) : explode(',', $course_type);

        // Ambil data tingkat untuk filter
        $tingkatLevels = KelasTatapMuka::where('status', 1) // Menambahkan kondisi status = 1
            ->distinct()
            ->pluck('tingkat');

        // Hitung jumlah kursus per tingkat
        $tingkatCounts = KelasTatapMuka::whereIn('course_type', $course_type)
            ->where('status', 1) // Menambahkan kondisi status = 1
            ->groupBy('tingkat')
            ->select('tingkat', DB::raw('count(*) as total'))
            ->pluck('total', 'tingkat');


        // Mencari berdasarkan kategori, tingkat, dan term pencarian dengan pagination
        $results = KelasTatapMuka::query()
            // ->whereIn('course_type', $course_type)
            ->where('status', 1)
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
                switch ($orderby) {
                    case 'latest':
                        return $query->orderBy('created_at', 'desc');
                    case 'oldest':
                        return $query->orderBy('created_at', 'asc');
                    case 'highest_price':
                        return $query->orderBy('price', 'desc');
                    case 'lowest_price':
                        return $query->orderBy('price', 'asc');
                }
            })
            ->paginate(10);

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get() : collect();

        // Hitung jumlah notifikasi yang belum dibaca
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Ambil ID kursus yang telah diikuti oleh user
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];

        // Hitung jumlah kursus per kategori
        $categoryCounts = KelasTatapMuka::select('kategori_id', DB::raw('count(*) as total'))
            ->whereIn('course_type', $course_type)
            ->groupBy('kategori_id')
            ->pluck('total', 'kategori_id');

        return view('search_results', compact(
            'results',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'user',
            'profile',
            'joinedCourses',
            'categoryCounts',
            'category_ids',
            'tingkatLevels',
            'tingkatCounts',
            'categori'
        ))->with('paginationView', 'vendor.custom');
    }
}
