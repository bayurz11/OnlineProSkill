<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DaftarSiswaController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        if (!$user) {
            return redirect()->route('login_admin');
        }

        $daftar_siswa = UserProfile::where('role_id', 3)->get();

        return view('admin.kesiswaan.daftar_siswa', compact('user', 'daftar_siswa', 'profile'));
    }

    public function updateStatus($id, Request $request)
    {
        $user_update = User::find($id);

        if ($user_update) {
            $user_update->status = $request->input('status');
            $user_update->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function edit($id)
    {
        $user = User::with('userProfile')->find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:3|confirmed',
        ]);

        // Cari user berdasarkan ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Update user dan user profile
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('daftar_siswa')->with('success', 'Siswa berhasil diupdate');
    }
}
