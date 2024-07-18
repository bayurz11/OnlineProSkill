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
        if (!$user) {
            return redirect()->route('login_admin');
        }

        $daftar_siswa = UserProfile::where('role_id', 3)->get();

        return view('admin.kesiswaan.daftar_siswa', compact('user', 'daftar_siswa'));
    }
}
