<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AksesPembelianController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();

        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Fetching orders related to the user
        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();

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

        return view('studen.aksespembelian', compact('user', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders'));
    }
    public function lesson($id)
    {
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();

        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Fetching orders related to the user
        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();
        $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();


        return view('studen.lesson', compact('user', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    }
}
