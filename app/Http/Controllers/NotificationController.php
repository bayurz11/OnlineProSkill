<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // public function getNotifications()
    // {
    //     // Ambil notifikasi untuk user yang sedang login
    //     $notifications = Notification::where('user_id', Auth::id())->get();

    //     return view('notifications.index', compact('notifications'));
    // }
    public function getNotifications()
    {
        // Ambil semua notifikasi pesanan berdasarkan perubahan status
        $notifications = Order::whereIn('status', ['paid', 'settled', 'pending'])
            ->where('user_id', Auth::id()) // Hanya untuk user yang sedang login
            ->orderBy('updated_at', 'desc')
            ->limit(6) // Batasi jumlah notifikasi
            ->get();

        return response()->json($notifications); // Kirim data sebagai response JSON
    }
}
