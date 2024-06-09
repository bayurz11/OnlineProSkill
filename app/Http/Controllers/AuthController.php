<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Mengecek apakah pengguna sudah login
        if (auth()->check()) {
            return view('admin.dashboard');
        } else {
            // Jika pengguna belum login, arahkan ke halaman login
            return redirect()->route('login');
        }
    }
}
