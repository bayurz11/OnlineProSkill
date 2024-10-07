<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PixelController extends Controller
{
    public function index()
    {
        // Menampilkan halaman pengaturan pixel
        $contactUs = ContactUs::all();
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }
        $pixelId = Session::get('pixel_id', ''); // Ambil dari session jika ada
        return view('admin.pixel.settings', compact('pixelId'));
    }

    public function store(Request $request)
    {
        // Validasi Pixel ID
        $request->validate([
            'pixel_id' => 'required|string'
        ]);

        // Simpan Pixel ID ke session atau ke database
        Session::put('pixel_id', $request->pixel_id);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.pixel.settings')->with('success', 'Pixel ID berhasil disimpan.');
    }
}
