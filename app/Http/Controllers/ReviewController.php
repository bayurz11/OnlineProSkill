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
use App\Models\Reviews;
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
            ->with('KelasTatapMuka', 'Reviews')
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

    public function store(Request $request)
    {
        // Memastikan user login
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not logged in'], 401); // Response JSON jika user tidak login
        }

        // Validasi data
        $request->validate([
            'class_id' => 'required|exists:classroom_master,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        // Cek apakah user sudah memberi review pada kelas ini
        $existingReview = Reviews::where('class_id', $request->class_id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingReview) {
            return response()->json(['error' => 'You have already reviewed this class.'], 400); // Response JSON jika sudah ada review
        }

        // Simpan review baru
        Reviews::create([
            'class_id' => $request->class_id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json(['success' => 'Review submitted successfully.'], 200); // Response JSON jika sukses
    }
}
