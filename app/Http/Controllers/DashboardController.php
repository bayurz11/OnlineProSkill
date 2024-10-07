<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $course = KelasTatapMuka::with('user')->where('course_type', 'offline')->get();
        $onlinecourse = KelasTatapMuka::with('user')->where('course_type', 'online')->get();
        $daftar_siswa = UserProfile::where('role_id', 3)->get();
        $orders = Order::with('KelasTatapMuka')->orderBy('created_at', 'desc')->get();
        $bootcamp = Order::with('KelasTatapMuka')
            ->where('course_type', 'bootcamp')
            ->orderBy('created_at', 'desc') // atau kolom lain yang diinginkan untuk diurutkan
            ->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.dashboard', compact('user', 'course', 'count', 'daftar_siswa', 'onlinecourse', 'orders', 'bootcamp'));
    }
}
