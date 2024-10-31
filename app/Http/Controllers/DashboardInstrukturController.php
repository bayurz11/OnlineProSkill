<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\Order;
use App\Models\Reviews;
use App\Models\UserRoles;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
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

        // Mengambil orders berdasarkan user_id yang sedang login
        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();

        // Mengambil kelas tatap muka sesuai dengan user_id yang sedang login
        $kelastatapmuka = KelasTatapMuka::where('user_id', $user->id)
            ->whereIn('id', function ($query) {
                $query->select('course_id')->from('kurikulum');
            })
            ->get();

        $kelastatapmukaCount = $kelastatapmuka->count();

        // Menghitung jumlah siswa unik yang terdaftar di kelas tatap muka
        $jumlahSiswa = Order::whereIn('product_id', $kelastatapmuka->pluck('id'))
            ->distinct('user_id') // Menghitung hanya siswa unik
            ->count('user_id');

        // Mengambil daftar pesanan kelas tatap muka berdasarkan user_id dan id yang ada di order
        $daftarpesanan = KelasTatapMuka::where('user_id', $user->id)
            ->whereIn('id', function ($query) {
                $query->select('product_id')->from('orders');
            })
            ->get();

        // Menambahkan jumlah order PAID untuk setiap kelas tatap muka ke dalam koleksi
        foreach ($daftarpesanan as $kelas) {
            $kelas->jumlah_order_paid = Order::where('product_id', $kelas->id)
                ->where('status', 'PAID')
                ->count();

            // Ambil ulasan untuk kelas
            $kelas->reviews = Reviews::where('class_id', $kelas->id)->with('user')->get();
            $kelas->average_rating = $kelas->reviews->avg('rating');
        }

        return view('instruktur.dashboard', compact('user', 'jumlahSiswa', 'daftarpesanan', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kelastatapmuka', 'kelastatapmukaCount'));
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
