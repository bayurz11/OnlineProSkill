<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('home.index', compact('user'));
    }
    public function classroom()
    {
        $user = Auth::user();
        $course = KelasTatapMuka::with('user')->where('status', 1)->get();
        $count = $course->count();
        return view('home.classroom', compact('user', 'count', 'course'));
    }

    public function classroomdetail($id)
    {
        $user = Auth::user();
        $course = KelasTatapMuka::all();
        $courses = KelasTatapMuka::find($id);
        $courseList = json_decode($courses->include, true);
        // Periksa apakah $klsoffline ditemukan
        if (!$courses) {
            abort(404, 'Kelas tatap muka tidak ditemukan.');
        }

        // Decode JSON fasilitas
        $fasilitas = json_decode($courses->fasilitas, true);
        return view('home.classroomdetail', compact('user', 'course', 'courses', 'courseList'));
    }

    public function checkout()
    {
        return view('home.checkout');
    }
}
