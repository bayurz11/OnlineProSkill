<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DashboardInstrukturController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('instruktur.dashboard');
    }
    public function showregister()
    {
        return view('instruktur.auth.register');
    }

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
            'status' => false,
        ]);

        $userRole = new UserRoles();
        $userRole->user_id = $user->id;
        $userRole->role_id = 2;
        $userRole->save();

        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id;
        $userProfile->role_id = 2;
        $userProfile->save();

        return redirect()->route('/')->with('success', 'Pendaftaran berhasil!');
    }
}
