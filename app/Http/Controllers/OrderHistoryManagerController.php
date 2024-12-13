<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Categories;
use App\Models\UserProfile;
use App\Models\OrderHistoryManager;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderHistoryManagerRequest;
use App\Http\Requests\UpdateOrderHistoryManagerRequest;

class OrderHistoryManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $categori = Categories::all();
        $count = $categori->count();

        if (!$user) {
            return redirect()->route('login_admin');
        }

        // Mengambil semua orders tanpa memfilter berdasarkan user_id
        $orders = Order::with('KelasTatapMuka')->get();

        // Debugging data
        foreach ($orders as $order) {
            Log::info('Order ID: ' . $order->id);
            if ($order->KelasTatapMuka) {
                Log::info('Kelas Tatap Muka ID: ' . $order->KelasTatapMuka->id);
                Log::info('Nama Kelas: ' . $order->KelasTatapMuka->nama_kelas);
            } else {
                Log::info('Kelas Tatap Muka: Not Found');
            }
        }

        return view('admin.CourseMaster.orderhistory', compact('user', 'categori', 'count', 'orders', 'profile'));
    }
    public function cetak($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.cetak', compact('order'));
    }
}
