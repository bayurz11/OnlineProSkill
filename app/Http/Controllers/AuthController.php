<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

            $userRole = $user->userRole;
            if (!$userRole) {
                return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
            }
            $roleName = $userRole->role->role_name;
            $userName = $user->name;
            switch ($roleName) {
                case 'Administrator':
                    return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Instruktur':
                    return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Studen':
                    $profile = $user->userProfile; // Perbaiki penggunaan relasi di sini
                    if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
                        return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan.');
                    } else {
                        return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                    }
                default:
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }
    public function loginstuden(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
            $user->save();

            $userRole = $user->userRole;
            if (!$userRole) {
                return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
            }
            $roleName = $userRole->role->role_name;
            $userName = $user->name;
            switch ($roleName) {
                case 'Administrator':
                    return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Instruktur':
                    return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Studen':
                    $profile = $user->userProfile; // Perbaiki penggunaan relasi di sini
                    if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
                        return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan.');
                    } else {
                        return redirect()->route('cart.view')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                    }
                default:
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
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
            'phone_number' => 'required|string|max:12',
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
        $userProfile->phone_number = $request->phone_number;
        $userProfile->save();

        Auth::login($user);

        return redirect()->route('profil')->with('info', 'Pendaftaran berhasil! Harap lengkapi profil Anda');
    }

    public function guestregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone_number' => 'required|string|max:12',
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
        $userProfile->phone_number = $request->phone_number;
        $userProfile->save();

        Auth::login($user);

        // Temukan course berdasarkan ID yang diterima sebagai parameter
        // $course = KelasTatapMuka::find($id);

        // Redirect ke halaman checkout dengan ID course
        // return redirect()->route('checkout', ['id' => $course->id]);
        return redirect()->route('cart.view');
    }
    // public function guestregister(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:3|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'last_login' => Carbon::now(),
    //         'status' => 1,
    //     ]);

    //     $userRole = new UserRoles();
    //     $userRole->user_id = $user->id;
    //     $userRole->role_id = 3;
    //     $userRole->save();

    //     $userProfile = new UserProfile();
    //     $userProfile->user_id = $user->id;
    //     $userProfile->role_id = 3;
    //     $userProfile->save();

    //     Auth::login($user);

    //     return redirect()->route('checkout');
    // }
}
