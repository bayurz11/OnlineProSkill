<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     // Validasi data yang diterima
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('registrasi')->withErrors($validator)->withInput();
    //     }

    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);

    //     $success['token'] = $user->createToken('auth_token')->plainTextToken;
    //     $success['name'] = $user->name;

    //     // Kembalikan data pengguna dan token
    //     return redirect()->route('login')->with([
    //         'success' => true,
    //         'message' => 'Sukses Registrasi',
    //         'data' => $success
    //     ]);
    // }

    public function register(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registrasi')->withErrors($validator)->withInput();
        }

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Simpan peran pengguna
        $user->role()->attach(1); // Sesuaikan dengan ID peran yang sesuai

        // Simpan profil pengguna (jika diperlukan)
        UserProfile::create([
            'user_id' => $user->id,
            'role_id' => 1, // Sesuaikan dengan ID peran yang sesuai
            // Tambahkan kolom lain yang perlu disimpan di sini
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with([
            'success' => true,
            'message' => 'Sukses Registrasi',
        ]);
    }



    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;
            return response()->json([
                'success' => true,
                'massage' => 'Login Sukses',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'Cek Email Dan Password Anda',
                'data' => null
            ]);
        }
    }
}
