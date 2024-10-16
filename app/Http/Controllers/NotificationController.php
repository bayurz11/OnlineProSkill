<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markNotificationsRead()
    {
        // Tandai semua notifikasi sebagai telah dibaca
        Order::where('user_id', Auth::id())
            ->where('notification_read', false)
            ->update(['notification_read' => true]);

        return response()->json(['message' => 'Notifications marked as read']);
    }
    public function getNotifications()
    {
        // Ambil semua notifikasi pesanan yang belum dibaca
        $notifications = Order::select('product_id', 'status', 'updated_at')
            ->whereIn('status', ['paid', 'settled', 'pending'])
            ->where('user_id', Auth::id())
            ->where('notification_read', false) // Ambil notifikasi yang belum dibaca
            ->orderBy('updated_at', 'desc')
            ->limit(6) // Batasi jumlah notifikasi
            ->get();

        return response()->json($notifications); // Kirim data sebagai response JSON
    }
}
