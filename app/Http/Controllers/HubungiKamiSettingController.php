<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HubungiKamiSettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }

        return view('admin.PengaturanUmum.contactUs', compact('user'));
    }
}
