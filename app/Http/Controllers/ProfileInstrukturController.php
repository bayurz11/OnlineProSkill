<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ContactUs;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileInstrukturController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $contactUs = ContactUs::first();

        $teleponList = json_decode($contactUs->telepon, true);
        if (!is_array($teleponList)) {
            $teleponList = [];
        }

        $emailList = json_decode($contactUs->email, true);
        if (!is_array($emailList)) {
            $emailList = [];
        }

        // Ambil profil instruktur berdasarkan ID dari URL
        $instructorProfile = UserProfile::where('user_id', $id)->first();

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Ambil data kelas berdasarkan instructor_id dari instructorProfile
        $kelas = [];
        if ($instructorProfile) {
            $kelas = KelasTatapMuka::where('user_id', $instructorProfile->user_id)->get();
        }
        $joinedCourses = $user ? Order::where('user_id', $user->id)->pluck('product_id')->toArray() : [];
        return view('home.pofile_instruktur.index', compact('user', 'joinedCourses', 'emailList', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'contactUs', 'teleponList', 'instructorProfile', 'kelas'));
    }
}
