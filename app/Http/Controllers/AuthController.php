<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\UserRoles;
use App\Models\Sertifikat;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
                    'secret' => config('services.recaptcha_v3.secret'),
                    'response' => $value,
                    'remoteip' => \request()->ip()
                ]);

                $g_response = $g_response->json();
                if (!$g_response['success']) {
                    $fail("The {$attribute} is invalid: " . implode(', ', $g_response['error-codes']));
                }
            },]
        ]);

        $credentials = $request->only('password');
        $emailOrPhone = $request->input('email_or_phone');

        // Mencari user berdasarkan email atau nomor telepon
        $user = User::where('email', $emailOrPhone)
            ->orWhereHas('userProfile', function ($query) use ($emailOrPhone) {
                $query->where('phone_number', $emailOrPhone);
            })
            ->first();

        // Memeriksa apakah user ditemukan dan password cocok
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Memeriksa status pengguna
            if ($user->status != 1) {
                return redirect()->back()->with('error', 'Akun Anda belum diaktifkan. Silakan hubungi admin.');
            }

            Auth::login($user);
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
                    return redirect()->route('dashboard_instruktur')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Studen':
                    $profile = $user->userProfile;
                    if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
                        return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan Transaksi.');
                    } else {
                        return redirect()->route('akses_pembelian')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                    }
                default:
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Email, nomor telepon, atau password salah.');
        }
    }
    public function loginstuden(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
                    'secret' => config('services.recaptcha_v3.secret'),
                    'response' => $value,
                    'remoteip' => \request()->ip()
                ]);

                $g_response = $g_response->json();
                if (!$g_response['success']) {
                    $fail("The {$attribute} is invalid: " . implode(', ', $g_response['error-codes']));
                }
            },]
        ]);

        $credentials = $request->only('password');
        $emailOrPhone = $request->input('email_or_phone');

        // Mencari user berdasarkan email atau nomor telepon
        $user = User::where('email', $emailOrPhone)
            ->orWhereHas('userProfile', function ($query) use ($emailOrPhone) {
                $query->where('phone_number', $emailOrPhone);
            })
            ->first();

        // Memeriksa apakah user ditemukan dan password cocok
        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Memeriksa status pengguna
            if ($user->status != 1) {
                return redirect()->back()->with('error', 'Akun Anda belum diaktifkan. Silakan hubungi admin.');
            }

            Auth::login($user);
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
                    return redirect()->route('dashboard_instruktur')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Studen':
                    $profile = $user->userProfile;
                    if (!$profile || !$profile->gambar || !$profile->date_of_birth || !$profile->phone_number) {
                        return redirect()->route('profil')->with('info', 'Harap lengkapi profil Anda untuk melanjutkan pembelian kelas.');
                    } else {
                        return redirect()->route('cart.view')->with('success', "Selamat datang, $userName! Silahkan Gabung Kelas Kami.");
                    }
                default:
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Email, nomor telepon, atau password salah.');
        }
    }




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


    // public function register(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:3|confirmed',
    //         'phone_number' => 'string|max:12|unique:user_profiles,phone_number',
    //         'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
    //             $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
    //                 'secret' => config('services.recaptcha_v3.secret'),
    //                 'response' => $value,
    //                 'remoteip' => \request()->ip()
    //             ]);

    //             $g_response = $g_response->json();
    //             if (!$g_response['success']) {
    //                 $fail("The {$attribute} is invalid: " . implode(', ', $g_response['error-codes']));
    //             }
    //         },]
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
    //     $userProfile->phone_number = $request->phone_number;
    //     $userProfile->save();

    //     Auth::login($user);

    //     return redirect()->route('profil')->with('info', 'Pendaftaran berhasil! Harap lengkapi profil Anda');
    // } 170724

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone_number' => 'string|max:12|unique:user_profile,phone_number',
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
                    'secret' => config('services.recaptcha_v3.secret'),
                    'response' => $value,
                    'remoteip' => \request()->ip()
                ]);

                $g_response = $g_response->json();
                if (!$g_response['success']) {
                    $fail("The {$attribute} is invalid: " . implode(', ', $g_response['error-codes']));
                }
            },]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Registrasi gagal! Email atau nomor telepon telah digunakan.');
        }

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

        $sertifikat = new Sertifikat();
        $sertifikat->name = $request->name;
        $sertifikat->user_id = $user->id;
        $sertifikat->save(); // Auto-generate id here

        // Update URL link after saving
        $sertifikat->link = url("/print/{$sertifikat->id}");
        $sertifikat->save(); // Save again to update the link

        Auth::login($user);

        return redirect()->route('profil')->with('info', 'Pendaftaran Berhasil! Harap Lengkapi Profil Anda Terlebih Dahulu.');
    }

    public function guestregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone_number' => 'string|max:12|unique:user_profile,phone_number',
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
                    'secret' => config('services.recaptcha_v3.secret'),
                    'response' => $value,
                    'remoteip' => \request()->ip()
                ]);

                $g_response = $g_response->json();
                if (!$g_response['success']) {
                    $fail("The {$attribute} is invalid: " . implode(', ', $g_response['error-codes']));
                }
            },]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Registrasi gagal! Email atau nomor telepon telah digunakan.');
        }

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

        $sertifikat = new Sertifikat();
        $sertifikat->name = $request->name;
        $sertifikat->user_id = $user->id;
        $sertifikat->save(); // Auto-generate id here

        // Update URL link after saving
        $sertifikat->link = url("/print/{$sertifikat->id}");
        $sertifikat->save(); // Save again to update the link
        Auth::login($user);

        return redirect()->route('cart.view')->with('info', 'Pendaftaran berhasil! Silahkan Gabung Kelas Kami');
    }
    public function bootcampregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'phone_number' => 'string|max:12|unique:user_profile,phone_number',
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
                    'secret' => config('services.recaptcha_v3.secret'),
                    'response' => $value,
                    'remoteip' => \request()->ip()
                ]);

                $g_response = $g_response->json();
                if (!$g_response['success']) {
                    $fail("The {$attribute} is invalid: " . implode(', ', $g_response['error-codes']));
                }
            },]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Registrasi gagal! Email atau nomor telepon telah digunakan.');
        }

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

        $sertifikat = new Sertifikat();
        $sertifikat->name = $request->name;
        $sertifikat->user_id = $user->id;
        $sertifikat->save(); // Auto-generate id here

        // Update URL link after saving
        $sertifikat->link = url("/print/{$sertifikat->id}");
        $sertifikat->save(); // Save again to update the link
        Auth::login($user);

        return redirect()->route('cart_bootcamp.view')->with('info', 'Pendaftaran berhasil! Silahkan Gabung Kelas Kami');
    }
}
