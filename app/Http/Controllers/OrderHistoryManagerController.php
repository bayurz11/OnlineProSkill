<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Categories;
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
        $categori = Categories::all();
        $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
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
        return view('admin.CourseMaster.orderhistory', compact('user', 'categori', 'count', 'orders'));
    }
}
