<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
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
        return view('studen.setting', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders'));
    }


    public function updateprofil(Request $request, $id)
    {
        $user = Auth::user();

        // Pastikan pengguna yang terautentikasi hanya dapat memperbarui profil mereka sendiri
        $profile = UserProfile::where('user_id', $user->id)->firstOrFail();

        // Validasi data permintaan
        $request->validate([
            'name' => 'required|string|max:255',
            'dateofBirth' => 'required|date',
            'gender' => 'required|string',
            'phonenumber' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        // Menangani upload gambar
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
            $profile->gambar = $fotoName;
        }

        // Perbarui data profil
        $profile->date_of_birth = $request->input('dateofBirth');
        $profile->gender = $request->input('gender');
        $profile->phone_number = $request->input('phonenumber');
        $profile->address = $request->input('alamat');
        $profile->bio = $request->input('bio');
        $profile->save();

        // Perbarui data pengguna
        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:3|confirmed',
        ]);

        // Cari user berdasarkan ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Update user dan user profile

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('profil')->with('success', 'Kata Sandi Berhasil Dirubah');
    }
}
