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
        $profile = UserProfile::where('user_id', $user->id)->first(); // Mengambil profil pengguna yang terkait

        return view('home.index', compact('user', 'profile'));
    }

    public function classroom()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $course = KelasTatapMuka::with('user')->where('status', 1)->get();
        $count = $course->count();
        return view('home.classroom', compact('user', 'count', 'course', 'profile'));
    }

    public function classroomdetail($id)
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $course = KelasTatapMuka::all();
        $courses = KelasTatapMuka::find($id);
        $courseList = json_decode($courses->include, true);
        // Periksa apakah $klsoffline ditemukan
        if (!$courses) {
            abort(404, 'Kelas tatap muka tidak ditemukan.');
        }

        // Decode JSON fasilitas
        $fasilitas = json_decode($courses->fasilitas, true);
        return view('home.classroomdetail', compact('user', 'course', 'courses', 'courseList', 'profile'));
    }

    public function checkout()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        return view('home.checkout', compact('user', 'profile'));
    }
}
