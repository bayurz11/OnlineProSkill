<?php

namespace App\Http\Controllers;

use App\Models\AdminEvent;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAdminEventRequest;
use App\Http\Requests\UpdateAdminEventRequest;

class AdminEventController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $event = AdminEvent::all();
        $count = $event->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.event.index', compact('user', 'event', 'count', 'profile'));
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

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'tgl' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi' => 'required|string|max:255',
            'link_maps' => 'required|string|max:255',
        ]);

        // Temukan event berdasarkan ID
        $event = AdminEvent::findOrFail($id);

        // Update field yang dapat diubah
        $event->name = $request->name;
        $event->tgl = $request->tgl;
        $event->lokasi = $request->lokasi;
        $event->link_maps = $request->link_maps;

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($event->gambar && file_exists(public_path('uploads/events/' . $event->gambar))) {
                unlink(public_path('uploads/events/' . $event->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events'), $filename);
            $event->gambar = $filename;
        }

        // Simpan perubahan ke database
        $event->save();

        // Redirect dengan pesan sukses
        return redirect()->route('kelola_event')->with('success', 'Data event berhasil diperbarui.');
    }


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
