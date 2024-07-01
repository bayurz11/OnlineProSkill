<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCartRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller
{
    public function index()
    {
        return view('home.cart');
    }

    // public function show()
    // {
    //     $user = Auth::user();
    //     $cart = Session::get('cart', []);
    //     $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
    //     $courses = KelasTatapMuka::whereIn('id', array_column($cart, 'id'))->get();
    //     if ($courses->isEmpty()) {
    //         return redirect()->route('cart.view')->with('info', 'Kelas tidak ditemukan.');
    //     }
    //     return view('home.cart', compact('user', 'cart', 'profile', 'courses'));
    // }
    public function show()
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $courses = KelasTatapMuka::whereIn('id', array_column($cart, 'id'))->get();

        if ($courses->isEmpty() && !empty($cart)) {
            return redirect()->route('cart.view')->with('info', 'Kelas tidak ditemukan.');
        }
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        return view('home.cart', compact('user', 'cart', 'profile', 'courses', 'notifikasiCount', 'notifikasi'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.view');
    }

    public function addToCartceckout($id)
    {
        $course = KelasTatapMuka::find($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "name" => $course->nama_kursus,
                "price" => $course->price,
                "gambar" => $course->gambar,
                "quantity" => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.view');
    }
    public function addToCart($id)
    {
        $course = KelasTatapMuka::find($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "name" => $course->nama_kursus,
                "price" => $course->price,
                "gambar" => $course->gambar,
                "quantity" => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('classroom');
    }
    public function addToCartdetail($id)
    {
        $course = KelasTatapMuka::find($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $id,
                "name" => $course->nama_kursus,
                "price" => $course->price,
                "gambar" => $course->gambar,
                "quantity" => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('classroomdetail', ['id' => $id]);
    }
    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.view');
    }
}
