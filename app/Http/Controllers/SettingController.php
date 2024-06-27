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
        $profile = UserProfile::all();
        if (!$user) {
            return redirect()->route('/');
        }
        return view('studen.setting', compact('user', 'profile'));
    }

    public function updateprofil(Request $request, $id)
    {
        $user = Auth::user();

        // Ensure the authenticated user is updating their own profile
        if ($user->id != $id) {
            return redirect()->route('profil')->with('error', 'Unauthorized action.');
        }

        $profile = UserProfile::findOrFail($id);

        // Validate the request data
        $request->validate([
            'dateofBirth' => 'required|date',
            'gender' => 'required|string',
            'phonenumber' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
            $profile->gambar = $fotoName;
        }

        // Update profile fields
        $profile->date_of_birth = $request->input('dateofBirth');
        $profile->gender = $request->input('gender');
        $profile->phone_number = $request->input('phonenumber');
        $profile->address = $request->input('alamat');
        $profile->bio = $request->input('bio');
        $profile->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
