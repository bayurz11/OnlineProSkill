<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function storeInstruktur(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone_number' => 'required|string|max:12|unique:user_profile,phone_number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Registrasi gagal! Email atau nomor telepon telah digunakan.');
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'last_login' => now(),
            'status' => 0, // Status default 0
        ]);

        // Tambahkan role untuk user sebagai instruktur
        UserRoles::create([
            'user_id' => $user->id,
            'role_id' => 2, // Role ID untuk Instruktur
        ]);

        // Tambahkan profil untuk user
        UserProfile::create([
            'user_id' => $user->id,
            'role_id' => 2, // Role ID untuk Instruktur
            'phone_number' => $request->phone_number,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Instruktur baru berhasil ditambahkan!');
    }
}
