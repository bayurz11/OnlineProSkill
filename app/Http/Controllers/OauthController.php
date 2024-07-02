<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        try {
            $userSocial = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('email', $userSocial->getEmail())->first();

            if ($findUser) {
                Auth::login($findUser);
                $findUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
                $findUser->save();
            } else {
                $newUser = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getEmail(),
                    'google_id' => $userSocial->getId(),
                    'password' => bcrypt('123456dummy') // Atau buatlah password secara acak
                ]);

                Auth::login($newUser);
                $newUser->last_login = now()->setTimezone('Asia/Jakarta')->toDateTimeString();
                $newUser->save();
            }

            $user = Auth::user();
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
                    $profile = $user->userProfile;
                    if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
                        return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan.');
                    } else {
                        return redirect()->route('/')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                    }
                default:
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login menggunakan Google.');
        }
    }
}
