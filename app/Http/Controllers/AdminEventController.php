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
        $event = AdminEvent::all();
        // $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.event.index', compact('user', 'event'));
    }


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
        $event->user_id = $userId;
        $event->save();

        return redirect()->route('kelola_event')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $event = AdminEvent::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json($event);
    }
    // public function update(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'sertifikat_id' => 'required|string|max:255',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'keterangan' => 'required|string|max:255',
    //     ]);

    //     // Temukan sertifikat berdasarkan ID
    //     $sertifikat = AdminEvent::findOrFail($id);

    //     // Update field yang dapat diubah
    //     $sertifikat->name = $request->name;
    //     $sertifikat->sertifikat_id = $request->sertifikat_id;
    //     $sertifikat->keterangan = $request->keterangan;

    //     // Cek apakah ada file gambar yang diunggah
    //     if ($request->hasFile('gambar')) {
    //         $file = $request->file('gambar');
    //         $filename = time() . '.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('uploads'), $filename);
    //         $sertifikat->gambar = $filename;
    //     }

    //     // Simpan perubahan ke database
    //     $sertifikat->save();

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('sertifikat')->with('success', 'Data sertifikat berhasil diperbarui.');
    // }

    public function destroy($id)
    {

        $event = AdminEvent::find($id);

        if (!$event) {
            return redirect()->route('kelola_event')->with('error', 'event tidak ditemukan');
        }

        $event->delete();

        return redirect()->route('kelola_event')->with('success', 'event berhasil dihapus');
    }
}
