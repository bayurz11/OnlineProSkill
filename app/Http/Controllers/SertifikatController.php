<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }

        return view('admin.sertifikat.index', compact('user'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'sertifikat_id' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'required|string|max:255',
        ]);

        // Cek apakah file gambar ada
        if ($request->hasFile('gambar')) {
            // Upload gambar
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);

            // Simpan data ke database
            $sertifikat = new Sertifikat();
            $sertifikat->name = $request->name;
            $sertifikat->sertifikat_id = $request->sertifikat_id;
            $sertifikat->gambar = $gambarName;
            $sertifikat->keterangan = $request->keterangan;
            $sertifikat->save();

            // Redirect dengan pesan sukses
            return redirect()->route('sertifikat')->with('success', 'Sertifikat berhasil disimpan.');
        } else {
            // Redirect dengan pesan error
            return redirect()->route('sertifikat')->with('error', 'Pilih gambar terlebih dahulu.');
        }
    }
}
