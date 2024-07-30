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
        // Validasi data yang dikirimkan
        $validatedData = $request->validated();

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/events'), $filename);
            $validatedData['gambar'] = 'uploads/events/' . $filename;
        }

        // Simpan data event ke database
        AdminEvent::create([
            'name' => $validatedData['name'],
            'gambar' => $validatedData['gambar'] ?? null,
            'tgl' => $validatedData['tgl'],
            'lokasi' => $validatedData['lokasi'],
            'link_maps' => $validatedData['link_maps'],
        ]);

        // Redirect atau response sukses
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
