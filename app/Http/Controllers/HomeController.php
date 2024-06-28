<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mengambil pengguna yang sedang login
        $profile = null;

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first(); // Mengambil profil pengguna yang terkait
        }

        return view('home.index', compact('user', 'profile'));
    }

    public function classroom()
    {
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $course = KelasTatapMuka::with('user')->where('status', 1)->get();
        $count = $course->count();
        return view('home.classroom', compact('user', 'count', 'course', 'profile', 'cart'));
    }

    public function classroomdetail($id)
    {
        $user = Auth::user();
        $profile = null;
        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }
        $courses = KelasTatapMuka::find($id);
        if (!$courses) {
            abort(404, 'Kelas tatap muka tidak ditemukan.');
        }
        $courseList = json_decode($courses->include, true);

        if (!is_array($courseList)) {
            $courseList = [];
        }
        $fasilitas = json_decode($courses->fasilitas, true);
        return view('home.classroomdetail', compact('user', 'courses', 'courseList', 'profile'));
    }


    public function checkout(Request $request, $id)
    {
        $user = Auth::user();
        $profile = null;

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $cart = json_decode($request->input('cart'), true);

        if (!$cart) {
            return redirect()->route('/')->with('error', 'Keranjang belanja kosong.');
        }

        $courses = KelasTatapMuka::whereIn('id', array_column($cart, 'id'))->get();
        if ($courses->isEmpty()) {
            return redirect()->route('/')->with('error', 'Kelas tidak ditemukan.');
        }
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "name" => $courses->nama_kursus, // Pastikan field name ada di model KelasTatapMuka
                "price" => $courses->price, // Pastikan field price ada di model KelasTatapMuka
                "gambar" => $courses->gambar,
                "quantity" => 1,
            ];
        }

        Session::put('cart', $cart);

        return view('home.checkout', compact('user', 'profile', 'courses'));
    }

    // public function checkout($id)
    // {
    //     $courses = KelasTatapMuka::find($id);

    //     if (!$courses) {
    //         abort(404, 'Kelas tatap muka tidak ditemukan.');
    //     }
    //     $user = Auth::user();
    //     $profile = null;

    //     if ($user) {
    //         $profile = UserProfile::where('user_id', $user->id)->first();
    //     }

    //     return view('home.checkout', compact('user', 'profile', 'courses'));
    // }
}
