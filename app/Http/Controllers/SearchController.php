<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
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
        $category_id = $request->input('category_id');
        $search_term = $request->input('search_term');

        // Mencari berdasarkan kategori dan term pencarian
        $results = KelasTatapMuka::where('kategori_id', $category_id)
            ->where('nama_kursus', 'like', '%' . $search_term . '%')
            ->get();
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        return view('search_results', compact('results', 'categori', 'cart', 'notifikasi', 'notifikasiCount', 'user'));
    }
}
