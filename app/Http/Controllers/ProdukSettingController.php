<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Facades\Auth;

class ProdukSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $course = KelasTatapMuka::with('user')->where('course_type', 'offline')->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.produk.produk', compact('user', 'categori', 'count', 'course'));
    }
}
