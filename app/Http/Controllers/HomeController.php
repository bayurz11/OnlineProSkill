<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        $course = KelasTatapMuka::with('user')->where('status', 1)->get();
        $count = $course->count();
        return view('home.classroom', compact('user', 'count', 'course', 'profile'));
    }

    public function classroomdetail($id)
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();
        $profile = null;

        // Jika user ditemukan, mencari profil user berdasarkan user_id
        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Mencari kelas tatap muka berdasarkan id yang diberikan
        $courses = KelasTatapMuka::find($id);

        // Jika kelas tatap muka tidak ditemukan, tampilkan halaman 404 dengan pesan error
        if (!$courses) {
            abort(404, 'Kelas tatap muka tidak ditemukan.');
        }

        // Mengubah data 'include' dari JSON menjadi array
        $courseList = json_decode($courses->include, true);

        // Memastikan bahwa $courseList adalah array
        if (!is_array($courseList)) {
            $courseList = [];
        }

        // Mengubah data 'fasilitas' dari JSON menjadi array
        $fasilitas = json_decode($courses->fasilitas, true);

        // Mengirim data ke view 'home.classroomdetail'
        return view('home.classroomdetail', compact('user', 'courses', 'courseList', 'profile'));
    }


    public function checkout($id)
    {
        $user = Auth::user();
        $profile = null;

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }
        $courses = KelasTatapMuka::find($id);
        if (!$courses) {
            return redirect()->route('home')->with('error', 'Kelas tidak ditemukan.');
        }
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
