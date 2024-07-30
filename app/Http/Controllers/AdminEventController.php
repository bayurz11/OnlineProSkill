<?php

namespace App\Http\Controllers;

use App\Models\AdminEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAdminEventRequest;
use App\Http\Requests\UpdateAdminEventRequest;

class AdminEventController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        // $categori = Categories::all();
        // $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.event.index', compact('user'));
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
    public function store(Request $request)
    {
        $userId = Auth::id();

        // Proses unggahan gambar
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/events'), $gambarName);
        } else {
            $gambarName = null;
        }

        // Buat entitas event baru
        $event = new AdminEvent();
        $event->name = $request->name;
        $event->gambar = $gambarName;
        $event->tgl = $request->tgl;
        $event->lokasi = $request->lokasi;
        $event->link_maps = $request->link_maps;
        $event->user_id = $userId; // Menambahkan user_id jika diperlukan
        $event->save();

        return redirect()->route('kelola_event')->with('success', 'Event berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(AdminEvent $adminEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminEvent $adminEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminEventRequest $request, AdminEvent $adminEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminEvent $adminEvent)
    {
        //
    }
}
