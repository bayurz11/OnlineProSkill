<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InstrukturSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login_admin');
        }

        $daftar_instruktur = UserProfile::where('role_id', 2)->get();

        return view('admin.kesiswaan.daftar_instruktur', compact('user', 'daftar_instruktur'));
    }
}
