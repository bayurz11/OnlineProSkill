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

        // Jika user tidak terautentikasi, redirect ke halaman utama
        if (!$user) {
            return redirect()->route('home'); // pastikan rute sesuai dengan nama rute home
        }

        // Coba ambil dari session terlebih dahulu
        $pixelId = Session::get('pixel_id', '');

        // Jika session pixel_id kosong, ambil dari database
        if (empty($pixelId)) {
            $pixelSetting = PixelSetting::latest()->first();
            $pixelId = $pixelSetting ? $pixelSetting->pixel_id : '';
            $apiToken = $pixelSetting ? $pixelSetting->api_token : '';
        } else {
            // Jika session ada, ambil juga api_token dari session
            $apiToken = Session::get('api_token', '');
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

        // Simpan Pixel ID dan API Token ke database
        PixelSetting::create([
            'pixel_id' => $request->pixel_id,
            'api_token' => $request->api_token,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pixel.settings')->with('success', 'Pixel ID dan API Token berhasil disimpan ke database.');
    }
}
