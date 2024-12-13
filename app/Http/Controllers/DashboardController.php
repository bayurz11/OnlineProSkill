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

        // Validasi data permintaan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);

        // Menghandle upload gambar profil
        if ($request->hasFile('profile_picture')) {
            $profilePictureName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads'), $profilePictureName);
            $user->profile_picture = $profilePictureName;
        }

        // Perbarui data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        // Simpan log aktivitas
        $log = new Log();
        $log->action = 'Update Profile';
        $log->description = 'Profil ' . $user->name . ' berhasil diperbarui.';
        $log->user_id = $user->id;
        $log->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    // Update password admin
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password saat ini tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        // Simpan log aktivitas
        $log = new Log();
        $log->action = 'Change Password';
        $log->description = 'Password ' . $user->name . ' berhasil diubah.';
        $log->user_id = $user->id;
        $log->save();

        return redirect()->route('admin.profile')->with('success', 'Password berhasil diubah.');
    }
}
