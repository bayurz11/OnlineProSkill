<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('/');
        }
        return view('studen.setting', compact('user'));
    }

    public function UpdateProfil(Request $request, $id)
    {
        $user = Auth::user();
        $profile = UserProfile::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);
            $profile->gambar = $gambarName;
        }
        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
