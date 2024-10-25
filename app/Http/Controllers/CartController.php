<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Categories;
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


    public function show()
    {
        $categori = Categories::all();
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;
        $courses = KelasTatapMuka::whereIn('id', array_column($cart, 'id'))->get();

        if ($courses->isEmpty() && !empty($cart)) {
            return redirect()->route('cart.view')->with('info', 'Kelas tidak ditemukan.');
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        return view('home.cart2', compact('user', 'categori', 'cart', 'profile', 'courses', 'notifikasiCount', 'notifikasi'));
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

        if (!isset($cart[$id])) {
            $cart[$id] = [
                "id" => $id,
                "name" => $course->nama_kursus,
                "discountedPrice" => $course->discountedPrice,
                "gambar" => $course->gambar,
                "quantity" => 1,
            ];

            Session::flash('success', 'Item telah ditambahkan ke keranjang!');
        } else {
            Session::flash('info', 'Item sudah ada di keranjang!');
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.view');
    }

    public function addToCart($id)
    {
        $course = KelasTatapMuka::find($id);
        $cart = Session::get('cart', []);

        if (!isset($cart[$id])) {
            $cart[$id] = [
                "id" => $id,
                "name" => $course->nama_kursus,
                "discountedPrice" => $course->discountedPrice,
                "gambar" => $course->gambar,
                "quantity" => 1,
            ];

            Session::flash('success', 'Item telah ditambahkan ke keranjang!');
        } else {
            Session::flash('info', 'Item sudah ada di keranjang!');
        }

        Session::put('cart', $cart);

        return redirect()->route('classroom');
    }


    public function addToCartdetail($id)

    {
        $course = KelasTatapMuka::find($id);
        $cart = Session::get('cart', []);

        if (!isset($cart[$id])) {
            $cart[$id] = [
                "id" => $id,
                "name" => $course->nama_kursus,
                "price" => $course->price,
                "gambar" => $course->gambar,
                "quantity" => 1,
            ];

            Session::flash('success', 'Item telah ditambahkan ke keranjang!');
        } else {
            Session::flash('info', 'Item sudah ada di keranjang!');
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
