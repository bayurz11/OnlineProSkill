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
        return view('home.index');
    }
    public function classroom()
    {
        $user = Auth::user();
        $course = KelasTatapMuka::with('user')->get();
        $count = $course->count();
        return view('home.classroom', compact('user', 'count', 'course'));
    }
    public function classroomdetail()
    {
        $user = Auth::user();
        $course = KelasTatapMuka::with('user')->get();
        return view('home.classroomdetail', compact('user', 'course'));
    }
    public function cart()
    {
        return view('home.cart');
    }
    public function checkout()
    {
        return view('home.checkout');
    }
}
