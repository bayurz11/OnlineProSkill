<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\Order;
use App\Models\UserRoles;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardInstrukturController extends Controller
{
    public function index()
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }
        // Mengambil profil pengguna yang sedang login
        $profile = UserProfile::where('user_id', $user->id)->first();
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();
        $kelastatapmuka = KelasTatapMuka::where('user_id', $user->id)
            ->whereIn('id', function ($query) {
                $query->select('course_id')
                    ->from('kurikulum');
            })
            ->get();
        $kelastatapmukaCount = $kelastatapmuka->count();
        return view('instruktur.dashboard', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kelastatapmuka', 'kelastatapmukaCount'));
    }
    public function profile()
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }
        // Mengambil profil pengguna yang sedang login
        $profile = UserProfile::where('user_id', $user->id)->first();
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();
        return view('instruktur.profile', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders'));
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
            'status' => 0, // Status default 0
        ]);

        $userRole = new UserRoles();
        $userRole->user_id = $user->id;
        $userRole->role_id = 2;
        $userRole->save();

        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id;
        $userProfile->role_id = 2;
        $userProfile->phone_number = $request->phone_number;
        $userProfile->save();

        // Cek status sebelum login
        if ($user->status == 0) {
            return redirect('/')->with('message', 'Akun Anda sedang dalam review oleh admin.');
        }

        // Jika status = 1, maka bisa login
        Auth::login($user);

        return redirect()->route('dashboard_instruktur')->with('success', 'Pendaftaran berhasil!');
    }
}
