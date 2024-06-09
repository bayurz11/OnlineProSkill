<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Showlogin()
    {
        return view('admin.auth.login');
    }
    public function showregistrasi()
    {
        return view('admin.auth.registrasi');
    }
    public function showdashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }
        return view('admin.dashboard', compact('user'));
    }
}
