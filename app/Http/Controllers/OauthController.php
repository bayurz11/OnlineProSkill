<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToProvidercart()
    {
        return Socialite::driver('google')->redirect();
    }

    // public function handleProviderCallback(Request $request)
    // {
    //     try {
    //         $userSocial = Socialite::driver('google')->user();
    //         $findUser = User::where('email', $userSocial->getEmail())->first();

    //         if ($findUser) {
    //             Auth::login($findUser);
    //             $findUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
    //             $findUser->save();
    //         } else {
    //             $newUser = User::create([
    //                 'name' => $userSocial->getName(),
    //                 'email' => $userSocial->getEmail(),
    //                 'google_id' => $userSocial->getId(),
    //                 'password' => bcrypt('123456dummy'), // Atau buatlah password secara acak
    //                 'status' => 1 // Menambahkan status pengguna baru
    //             ]);

    //             // Menyimpan last_login pengguna baru
    //             $newUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
    //             $newUser->save();

    //             // Menyimpan role pengguna baru
    //             $userRole = new UserRoles();
    //             $userRole->user_id = $newUser->id;
    //             $userRole->role_id = 3; // Sesuaikan role_id sesuai kebutuhan
    //             $userRole->save();

    //             // Menyimpan profil pengguna baru
    //             $userProfile = new UserProfile();
    //             $userProfile->user_id = $newUser->id;
    //             $userProfile->role_id = 3; // Sesuaikan role_id sesuai kebutuhan
    //             $userProfile->gambar = $userSocial->getAvatar(); // Menyimpan foto profil
    //             $userProfile->save();

    //             Auth::login($newUser);
    //         }

    //         $user = Auth::user();
    //         $userRole = $user->userRole;

    //         if (!$userRole) {
    //             return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
    //         }

    //         $roleName = $userRole->role->role_name;
    //         $userName = $user->name;
    //         switch ($roleName) {
    //             case 'Administrator':
    //                 return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //             case 'Instruktur':
    //                 return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //             case 'Studen':
    //                 $profile = $user->userProfile;
    //                 if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
    //                     return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan.');
    //                 } else {
    //                     return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //                 }
    //             default:
    //                 return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
    //         }
    //     } catch (Exception $e) {
    //         return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login menggunakan Google.');
    //     }
    // }
    // public function handleProviderCallback(Request $request)
    // {
    //     try {
    //         $userSocial = Socialite::driver('google')->user();
    //         $findUser = User::where('email', $userSocial->getEmail())->first();

    //         if ($findUser) {
    //             Auth::login($findUser);
    //             $findUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
    //             $findUser->save();
    //         } else {
    //             $newUser = User::create([
    //                 'name' => $userSocial->getName(),
    //                 'email' => $userSocial->getEmail(),
    //                 'google_id' => $userSocial->getId(),
    //                 'password' => bcrypt('123456dummy'), // Atau buatlah password secara acak
    //                 'status' => 1 // Menambahkan status pengguna baru
    //             ]);

    //             // Menyimpan last_login pengguna baru
    //             $newUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
    //             $newUser->save();

    //             // Menyimpan role pengguna baru
    //             $userRole = new UserRoles();
    //             $userRole->user_id = $newUser->id;
    //             $userRole->role_id = 3; // Sesuaikan role_id sesuai kebutuhan
    //             $userRole->save();

    //             // Menyimpan profil pengguna baru
    //             $userProfile = new UserProfile();
    //             $userProfile->user_id = $newUser->id;
    //             $userProfile->role_id = 3; // Sesuaikan role_id sesuai kebutuhan
    //             $userProfile->gambar = $userSocial->getAvatar(); // Menyimpan URL gambar langsung dari Google
    //             \Log::info('Avatar URL: ' . $userSocial->getAvatar()); // Debug URL Avatar
    //             $userProfile->save();

    //             Auth::login($newUser);
    //         }

    //         $user = Auth::user();
    //         $userRole = $user->userRole;

    //         if (!$userRole) {
    //             return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
    //         }

    //         $roleName = $userRole->role->role_name;
    //         $userName = $user->name;
    //         switch ($roleName) {
    //             case 'Administrator':
    //                 return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //             case 'Instruktur':
    //                 return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //             case 'Studen':
    //                 $profile = $user->userProfile;
    //                 if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
    //                     return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan.');
    //                 } else {
    //                     return redirect()->route('akses_pembelian')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //                 }
    //             default:
    //                 return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
    //         }
    //     } catch (Exception $e) {
    //         \Log::error('Google login error: ' . $e->getMessage()); // Debug error
    //         return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login menggunakan Google.');
    //     }
    // }190724
    public function handleProviderCallback(Request $request)
    {
        try {
            $userSocial = Socialite::driver('google')->user();
            $findUser = User::where('email', $userSocial->getEmail())->first();

            if ($findUser) {
                // Jika pengguna ditemukan, login
                Auth::login($findUser);

                // Memeriksa status pengguna
                if ($findUser->status != 1) {
                    // Logout dan redirect ke halaman login dengan pesan error
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Akun Anda belum diaktifkan. Silakan hubungi admin.');
                }

                // Update last_login jika status aktif
                $findUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
                $findUser->save();
            } else {
                // Jika pengguna tidak ditemukan, buat pengguna baru
                $newUser = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getEmail(),
                    'google_id' => $userSocial->getId(),
                    'password' => bcrypt('123456dummy'), // Password dummy untuk pengguna baru
                    'status' => 1 // Status aktif untuk pengguna baru
                ]);

                $newUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
                $newUser->save();

                UserRoles::create([
                    'user_id' => $newUser->id,
                    'role_id' => 3 // Sesuaikan role_id sesuai kebutuhan
                ]);

                UserProfile::create([
                    'user_id' => $newUser->id,
                    'role_id' => 3,
                    'gambar' => $userSocial->getAvatar()
                ]);

                Auth::login($newUser);
            }

            $user = Auth::user();
            $userRole = $user->userRole;

            if (!$userRole) {
                Auth::logout();
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
                    $profile = $user->userProfile;
                    if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
                        return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan.');
                    } else {
                        return redirect()->route('akses_pembelian')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                    }
                default:
                    Auth::logout();
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } catch (Exception $e) {
            \Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login menggunakan Google.');
        }
    }


    // public function handleProviderCallbackcart(Request $request)
    // {
    //     try {
    //         $userSocial = Socialite::driver('google')->user();
    //         $findUser = User::where('email', $userSocial->getEmail())->first();

    //         if ($findUser) {
    //             Auth::login($findUser);
    //             $findUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
    //             $findUser->save();
    //         } else {
    //             $newUser = User::create([
    //                 'name' => $userSocial->getName(),
    //                 'email' => $userSocial->getEmail(),
    //                 'google_id' => $userSocial->getId(),
    //                 'password' => bcrypt('123456'), // Atau buatlah password secara acak
    //                 'status' => 1 // Menambahkan status pengguna baru
    //             ]);

    //             // Menyimpan last_login pengguna baru
    //             $newUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
    //             $newUser->save();

    //             // Menyimpan role pengguna baru
    //             $userRole = new UserRoles();
    //             $userRole->user_id = $newUser->id;
    //             $userRole->role_id = 3; // Sesuaikan role_id sesuai kebutuhan
    //             $userRole->save();

    //             // Menyimpan profil pengguna baru
    //             $userProfile = new UserProfile();
    //             $userProfile->user_id = $newUser->id;
    //             $userProfile->role_id = 3; // Sesuaikan role_id sesuai kebutuhan
    //             $userProfile->gambar = $userSocial->getAvatar(); // Menyimpan URL gambar langsung dari Google
    //             \Log::info('Avatar URL: ' . $userSocial->getAvatar()); // Debug URL Avatar
    //             $userProfile->save();

    //             Auth::login($newUser);
    //         }

    //         $user = Auth::user();
    //         $userRole = $user->userRole;

    //         if (!$userRole) {
    //             return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
    //         }

    //         $roleName = $userRole->role->role_name;
    //         $userName = $user->name;
    //         switch ($roleName) {
    //             case 'Administrator':
    //                 return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //             case 'Instruktur':
    //                 return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //             case 'Studen':
    //                 $profile = $user->userProfile;
    //                 if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
    //                     return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan.');
    //                 } else {
    //                     return redirect()->route('cart.view')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
    //                 }
    //             default:
    //                 return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
    //         }
    //     } catch (Exception $e) {
    //         \Log::error('Google login error: ' . $e->getMessage()); // Debug error
    //         return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login menggunakan Google.');
    //     }
    // }
}
