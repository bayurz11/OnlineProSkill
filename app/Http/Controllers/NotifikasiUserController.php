<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreNotifikasiUserRequest;
use App\Http\Requests\UpdateNotifikasiUserRequest;

class NotifikasiUserController extends Controller
{

    public function index()
    {
        $cart = Session::get('cart', []);
        $profile = null;
        $user = Auth::user();

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = Notifikasiuser::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        // Kirim notifikasi ke view
        return view('studen.notifikasi.index', compact('notifikasi', 'cart', 'profile', 'user'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotifikasiUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NotifikasiUser $notifikasiUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotifikasiUser $notifikasiUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotifikasiUserRequest $request, NotifikasiUser $notifikasiUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotifikasiUser $notifikasiUser)
    {
        //
    }
}
