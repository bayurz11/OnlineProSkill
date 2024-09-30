<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BootcampController extends Controller
{
    public function index()
    {
        return view('bootcamp.index');
    }
}
