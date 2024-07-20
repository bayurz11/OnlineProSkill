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
        $category_id = $request->input('category_id');
        $search_term = $request->input('search_term');

        // Mencari berdasarkan kategori dan term pencarian
        $results = KelasTatapMuka::query()
            ->when($category_id, function ($query, $category_id) {
                return $query->where('kategori_id', $category_id);
            })
            ->when($search_term, function ($query, $search_term) {
                return $query->where('nama_kursus', 'like', '%' . $search_term . '%');
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

        return view('search_results', compact('results', 'categori', 'cart', 'notifikasi', 'notifikasiCount', 'user', 'profile', 'jumlahPendaftaran', 'joinedCourses', 'course'));
    }
}
