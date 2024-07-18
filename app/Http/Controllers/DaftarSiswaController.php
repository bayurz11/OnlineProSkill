<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class DaftarSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $daftar_siswa = UserProfile::all();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.kesiswaan.daftar_siswa', compact('user', 'daftar_siswa'));
    }
}
