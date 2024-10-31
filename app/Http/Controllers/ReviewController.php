<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use App\Models\UserSectionStatus;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index()
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }
        $userSectionStatus = UserSectionStatus::all();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $KelasTatapMuka = KelasTatapMuka::inRandomOrder()->get();
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Fetching orders related to the user with status PAID and SETTLED
        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();

        $kurikulum = Kurikulum::all();

        // Debugging data
        foreach ($orders as $order) {
            Log::info('Order ID: ' . $order->id);
            if ($order->KelasTatapMuka) {
                Log::info('Kelas Tatap Muka ID: ' . $order->KelasTatapMuka->id);
                Log::info('Kelas Tatap Muka Name: ' . $order->KelasTatapMuka->nama_kelas);
            } else {
                Log::info('Kelas Tatap Muka: Not Found');
            }
        }

        return view('studen.review.index', compact('user', 'userSectionStatus', 'categori', 'profile', 'cart', 'KelasTatapMuka', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    }
}
