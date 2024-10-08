<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\PixelSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PixelController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect jika user belum login
        if (!$user) {
            return redirect()->route('/');
        }

        // Coba ambil Pixel ID dan API Token dari session
        $pixelId = Session::get('pixel_id', '');
        $apiToken = Session::get('api_token', '');

        // Jika session kosong, ambil dari database
        if (empty($pixelId)) {
            $pixelSetting = PixelSetting::latest()->first();
            if ($pixelSetting) {
                $pixelId = $pixelSetting->pixel_id;
                $apiToken = $pixelSetting->api_token;
                // Simpan ke session
                Session::put('pixel_id', $pixelId);
                Session::put('api_token', $apiToken);
            }
        }

        // Kirim data ke view
        return view('admin.pixel.settings', compact('pixelId', 'user', 'apiToken'));
    }



    public function store(Request $request)
    {
        // Validasi Pixel ID dan API Token
        $request->validate([
            'pixel_id' => 'required|string',
            'api_token' => 'required|string'
        ]);

        // Simpan ke session
        Session::put('pixel_id', $request->pixel_id);
        Session::put('api_token', $request->api_token);

        // Simpan ke database
        PixelSetting::create([
            'pixel_id' => $request->pixel_id,
            'api_token' => $request->api_token,
        ]);



        // Redirect dengan pesan sukses
        return redirect()->route('pixel.settings')->with('success', 'Pixel ID dan API Token berhasil disimpan ke database.');
    }
}
