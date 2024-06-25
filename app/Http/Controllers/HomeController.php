<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    public function classroom()
    {
        return view('home.classroom');
    }
    public function classroomdetail()
    {
        return view('home.classroomdetail');
    }
}
