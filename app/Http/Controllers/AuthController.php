<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Showlogin()
    {
        return view('admin.auth.login');
    }
    public function showregistrasi()
    {
        return view('admin.auth.registrasi');
    }
    public function showdashboard()
    {

        return view('admin.dashboard');
    }
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;

            // Assuming the user role is obtained like this
            $userRole = $auth->userRole;

            // If the user does not have a role
            if (!$userRole) {
                return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
            }

            // Get the role name
            $roleName = $userRole->role->role_name;
            $userName = $auth->name;

            // Redirect based on user role
            switch ($roleName) {
                case 'Administrator':
                    return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Studen':
                    return redirect()->route('dashboard_siswa')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Instruktur':
                    return redirect()->route('dashboard_instruktur')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                default:
                    return redirect()->route('login')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } else {
            // Email atau kata sandi yang salah
            return redirect()->route('login')->with('error', 'Email atau kata sandi yang Anda masukkan salah.');
        }
    }
}
