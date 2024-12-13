<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\UserProfile;
use App\Models\PixelSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PixelController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        // Redirect ke halaman login jika user belum login
        if (!$user) {
            return redirect()->route('login'); // Pastikan ini rute login yang benar
        }

        // Coba ambil Pixel ID dan API Token dari session
        $pixelId = Session::get('pixel_id', null);
        $apiToken = Session::get('api_token', null);

        // Jika session kosong, ambil dari database
        if (is_null($pixelId)) {
            $pixelSetting = PixelSetting::latest()->first();
            if ($pixelSetting) {
                $pixelId = $pixelSetting->pixel_id;
                $apiToken = $pixelSetting->api_token;

                // Simpan ke session
                Session::put('pixel_id', $pixelId);
                Session::put('api_token', $apiToken);
            }
        }


        // Kirim data ke view, termasuk user yang sedang login
        return view('admin.pixel.settings', compact('pixelId', 'user', 'apiToken', 'profile'));
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
