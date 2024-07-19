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
        $categori = Categories::all();
        $category_id = $request->input('category_id');
        $search_term = $request->input('search_term');

        // Mencari berdasarkan kategori dan term pencarian
        $results = KelasTatapMuka::where('kategori_id', $category_id)
            ->where('nama_kursus', 'like', '%' . $search_term . '%')
            ->get();

        return view('search_results', compact('results', ' categori'));
    }
}
