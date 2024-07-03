<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RiwayatTransaksiController extends Controller
{
    // public function index()
    // {
    //     $cart = Session::get('cart', []);
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->route('home');
    //     }

    //     $profile = UserProfile::where('user_id', $user->id)->first();

    //     $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         : collect();

    //     $notifikasiCount = $notifikasi->where('status', 1)->count();

    //     return view('studen.history', compact('user', 'profile', 'cart', 'notifikasi', 'notifikasiCount'));
    // }
    // public function index()
    // {
    //     $cart = Session::get('cart', []);
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->route('home');
    //     }

    //     $profile = UserProfile::where('user_id', $user->id)->first();

    //     $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         : collect();

    //     $notifikasiCount = $notifikasi->where('status', 1)->count();

    //     // Fetching orders related to the user
    //     $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();

    //     return view('studen.history', compact('user', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders'));
    // }

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
            Log::info('Kelas Tatap Muka ID: ' . $order->KelasTatapMuka->id);
            Log::info('Kelas Tatap Muka Name: ' . $order->KelasTatapMuka->nama_kelas);
        }

        dd($orders);

        return view('studen.history', compact('user', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders'));
    }
}
