<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BootcampsettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $course = KelasTatapMuka::with('user')->where('course_type', 'online')->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }

        return view('admin.Bootcamp.bootcampsetting', compact('user', 'categori', 'count', 'course'));
    }
}
