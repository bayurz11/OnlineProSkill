<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }
    public function showregister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Add the new user to the user_roles table
        $userRole = new UserRoles();
        $userRole->user_id = $user->id;
        $userRole->role_id = 1; // Adjust to the appropriate role ID
        $userRole->save();

        // Add user_id to the user_profiles table
        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id; // Insert the new user_id
        $userProfile->role_id = 1;
        $userProfile->save();

        return redirect()->route('/')->with('success', 'Pendaftaran berhasil!');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
            $user->save();

            // Ambil peran pengguna
            $userRole = $user->userRole;

            // Jika pengguna tidak memiliki peran
            if (!$userRole) {
                return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
            }

            // Redirect berdasarkan peran pengguna
            $roleName = $userRole->role->role_name;
            $userName = $user->name;
            switch ($roleName) {
                case 'Administrator':
                    return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                    break;
                case 'Kasir':
                    return redirect()->route('dashboard_kasir')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                    break;
                default:
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $userName = $user->name;
        Auth::logout();

        // Redirect pengguna ke halaman login dengan pesan berhasil logout
        return redirect()->route('/')->with('success', "Terimakasih, $userName! keluar.");
    }
}
