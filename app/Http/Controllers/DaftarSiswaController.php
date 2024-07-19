<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        $section = UserProfile::find($id);

        if (!$section) {
            return response()->json(['message' => 'Kurikulum tidak ditemukan'], 404);
        }

        return response()->json($section);
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:255',
            'phone_number' => 'required|string|max:12',
            'address' => 'required|string|max:255',
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
        ]);

        $user->userProfile()->update([
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        return response()->json(['message' => 'User berhasil diupdate'], 200);
    }
}
