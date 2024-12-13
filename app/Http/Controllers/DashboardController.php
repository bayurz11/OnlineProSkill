<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Order;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $course = KelasTatapMuka::with('user')->where('course_type', 'offline')->get();
        $onlinecourse = KelasTatapMuka::with('user')->where('course_type', 'online')->get();
        $daftar_siswa = UserProfile::where('role_id', 3)->get();
        $orders = Order::with('KelasTatapMuka')
            ->whereHas('KelasTatapMuka', function ($query) {
                $query->where('course_type', 'offline', 'online');
            })
            ->get();
        $bootcamp = Order::with('KelasTatapMuka')
            ->whereHas('KelasTatapMuka', function ($query) {
                $query->where('course_type', 'bootcamp');
            })
            ->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.dashboard', compact('user', 'profile', 'course', 'count', 'daftar_siswa', 'onlinecourse', 'orders', 'bootcamp'));
    }
    public function profile()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $course = KelasTatapMuka::with('user')->where('course_type', 'offline')->get();
        $onlinecourse = KelasTatapMuka::with('user')->where('course_type', 'online')->get();
        $daftar_siswa = UserProfile::where('role_id', 3)->get();
        $orders = Order::with('KelasTatapMuka')
            ->whereHas('KelasTatapMuka', function ($query) {
                $query->where('course_type', 'offline', 'online');
            })
            ->get();
        $bootcamp = Order::with('KelasTatapMuka')
            ->whereHas('KelasTatapMuka', function ($query) {
                $query->where('course_type', 'bootcamp');
            })
            ->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.profile', compact('user', 'course', 'profile', 'count', 'daftar_siswa', 'onlinecourse', 'orders', 'bootcamp'));
    }
    // Update profil admin
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        // Pastikan pengguna yang terautentikasi hanya dapat memperbarui profil mereka sendiri
        $profile = UserProfile::where('user_id', $user->id)->firstOrFail();

        // Validasi data permintaan
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        // Menangani upload gambar profil
        if ($request->hasFile('foto')) {
            $profilePictureName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $profilePictureName);
            $profile->gambar = $profilePictureName;
        }

        // Perbarui data profil
        $profile->date_of_birth = $request->input('dateofBirth');
        $profile->gender = $request->input('gender');
        $profile->phone_number = $request->input('phone_number');
        $profile->address = $request->input('alamat');
        $profile->save();

        // Update user name
        $user->update([
            'name' => $request->name,
        ]);

        // Menyimpan data ke tabel logs
        $log = new Log();
        $log->action = 'Update Profile';
        $log->description = 'Profil ' . $user->name . ' berhasil diperbarui.';
        $log->user_id = $user->id;
        $log->save();

        return redirect()->route('adminProfile')->with('success', 'Profil berhasil diperbarui.');
    }



    // Update password admin
    public function updatePassword(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'password' => 'nullable|string|min:3|confirmed',
        ]);

        // Cari user berdasarkan ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // Update user dan user profile
        $user->update([
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);


        return redirect()->route('adminProfile')->with('success', 'Kata Sandi Berhasil Dirubah');
    }
}
