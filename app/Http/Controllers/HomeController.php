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

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mengambil pengguna yang sedang login
        $profile = null;
        $cart = Session::get('cart', []);
        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first(); // Mengambil profil pengguna yang terkait
        }
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        return view('home.index', compact('user', 'profile', 'cart', 'notifikasiCount', 'notifikasi'));
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
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        return view('home.classroom', compact('user', 'count', 'course', 'profile', 'cart', 'notifikasiCount', 'notifikasi'));
    }

    public function classroomdetail($id)
    {
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
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
        return view('home.classroomdetail', compact('user', 'courses', 'courseList', 'profile', 'cart'));
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

        return view('home.checkout', compact('user', 'profile', 'courses', 'cart'));
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
