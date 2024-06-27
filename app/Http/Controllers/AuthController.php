<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
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

            // Pengecekan bagian profil pengguna
            if (!$user->gambar || !$user->phone_number || !$user->address) {
                return redirect()->route('profil')->with('info', 'Silakan lengkapi profil Anda terlebih dahulu.');
            } else {
                // Jika sudah lengkap, redirect berdasarkan peran pengguna
                $roleName = $userRole->role->role_name;
                $userName = $user->name;
                switch ($roleName) {
                    case 'Administrator':
                        return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                        break;
                    case 'Instruktur':
                        return redirect('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                        break;
                    case 'Student':
                        return redirect('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                        break;
                    default:
                        return redirect('/')->with('error', 'Peran pengguna tidak dikenali.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }


    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $user->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
    //         $user->save();

    //         // Ambil peran pengguna
    //         $userRole = $user->userRole;

    //         // Jika pengguna tidak memiliki peran
    //         if (!$userRole) {
    //             return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
    //         }

    //         // Redirect berdasarkan peran pengguna
    //         $roleName = $userRole->role->role_name;
    //         $userName = $user->name;
    //         switch ($roleName) {
    //             case 'Administrator':
    //                 return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //                 break;
    //             case 'Instruktur':
    //                 return redirect()->route('dashboard_instruktur')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //                 break;
    //             case 'Studen':
    //                 return redirect()->route('dashboard_studen')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //                 break;
    //             default:
    //                 return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Email atau password salah.');
    //     }
    // }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $userName = $user->name;

        // Ambil peran pengguna
        $userRole = $user->userRole;

        // Jika pengguna tidak memiliki peran
        if (!$userRole) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
        }

        // Redirect berdasarkan peran pengguna
        $roleName = $userRole->role->role_name;
        Auth::logout();

        switch ($roleName) {
            case 'Administrator':
                $redirectRoute = '/';
                break;
            case 'Instruktur':
                $redirectRoute = '/';
                break;
            case 'Studen':
                $redirectRoute = '/';
                break;
            default:
                $redirectRoute = '/'; // Default redirect jika peran tidak dikenali
                break;
        }

        // Redirect pengguna ke halaman login yang sesuai dengan pesan berhasil logout
        return redirect()->route($redirectRoute)->with('success', "Terimakasih, $userName! Anda Berhasil keluar.");
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'last_login' => Carbon::now(),
            'status' => 1,
        ]);

        $userRole = new UserRoles();
        $userRole->user_id = $user->id;
        $userRole->role_id = 3;
        $userRole->save();

        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id;
        $userProfile->role_id = 3;
        $userProfile->save();

        return redirect()->route('setting')->with('success', 'Pendaftaran berhasil!');
    }
}
