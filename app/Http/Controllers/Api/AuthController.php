<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registrasi')->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        // Buat pengguna baru
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        // Kembalikan data pengguna dan token
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
    // public function register(Request $request)
    // {
    //     // Validasi data yang diterima
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Ada Kesalahan',
    //             'data' => $validator->errors()
    //         ]);
    //     }

    //     // Buat pengguna baru
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //     ]);

    //     // Tambahkan pengguna baru ke dalam tabel user_roles
    //     $userRole = new UserRoles();
    //     $userRole->user_id = $user->id;
    //     $userRole->role_id = 1; // Sesuaikan dengan ID role yang sesuai
    //     $userRole->save();

    //     // Tambahkan user_id ke dalam tabel user_profiles
    //     $userProfile = new UserProfile();
    //     $userProfile->user_id = $user->id; // Masukkan user_id baru
    //     $userProfile->save();

    //     // Buat token
    //     $success['token'] = $user->createToken('auth_token')->plainTextToken;
    //     $success['name'] = $user->name;

    //     // Kembalikan data pengguna dan token
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Sukses Registrasi',
    //         'data' => $success
    //     ]);
    // }
}
