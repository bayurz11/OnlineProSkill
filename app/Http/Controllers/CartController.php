<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
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

    public function create()
    {
        //
    }

    public function store(StoreCartRequest $request)
    {
        //
    }

    public function show()
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);
        $profile = $user ? UserProfile::where('user_id', $user->id)->first() : null;

        return view('home.cart', compact('user', 'cart', 'profile'));
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
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

    public function destroy(Cart $cart)
    {
        //
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
                "name" => $course->nama_kursus, // Pastikan field name ada di model KelasTatapMuka
                "price" => $course->price, // Pastikan field price ada di model KelasTatapMuka
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
                "name" => $course->nama_kursus, // Pastikan field name ada di model KelasTatapMuka
                "price" => $course->price, // Pastikan field price ada di model KelasTatapMuka
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
