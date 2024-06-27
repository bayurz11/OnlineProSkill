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

        // Mengambil profil pengguna yang sedang login
        $profile = UserProfile::where('user_id', $user->id)->first();

        return view('studen.setting', compact('user', 'profile'));
    }

    public function updateprofil(Request $request, $id)
    {
        $user = Auth::user();

        // Pastikan pengguna yang terautentikasi hanya dapat memperbarui profil mereka sendiri
        $profile = UserProfile::where('user_id', $user->id)->firstOrFail();

        // Validasi data permintaan
        $request->validate([
            'dateofBirth' => 'required|date',
            'gender' => 'required|string',
            'phonenumber' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // Menangani upload gambar
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
            $profile->gambar = $fotoName;
        }

        // Perbarui data profil
        $profile->date_of_birth = $request->input('dateofBirth');
        $profile->gender = $request->input('gender');
        $profile->phone_number = $request->input('phonenumber');
        $profile->address = $request->input('alamat');
        $profile->bio = $request->input('bio');
        $profile->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
