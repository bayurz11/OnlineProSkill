<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Section;
use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AksesPembelianController extends Controller
{
    // public function index()
    // {
    //     $categori = Categories::all();
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
    //     $kurikulum = Kurikulum::all();
    //     // Debugging data
    //     foreach ($orders as $order) {
    //         Log::info('Order ID: ' . $order->id);
    //         if ($order->KelasTatapMuka) {
    //             Log::info('Kelas Tatap Muka ID: ' . $order->KelasTatapMuka->id);
    //             Log::info('Kelas Tatap Muka Name: ' . $order->KelasTatapMuka->nama_kelas);
    //         } else {
    //             Log::info('Kelas Tatap Muka: Not Found');
    //         }
    //     }

    //     return view('studen.aksespembelian', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    // }220724
    public function index()
    {
        $categori = Categories::all();
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

        return view('studen.aksespembelian', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    }

    public function lesson($id)
    {
        $categori = Categories::all();
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


        return view('studen.lesson', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    }

    public function getContent($id)
    {
        $section = Section::findOrFail($id);
        return response()->json([
            'title' => $section->title,
            'file_type' => $section->file_type,
            'file_path' => asset($section->file_path),
        ]);
    }
}
