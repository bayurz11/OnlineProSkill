<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BootcampsettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $categori = Categories::all();
        $course = KelasTatapMuka::with('user')->where('course_type', 'bootcamp')->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }

        return view('admin.Bootcamp.bootcampsetting', compact('user', 'categori', 'count', 'course', 'profile'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        // Proses unggahan gambar
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);
        } else {
            $gambarName = null;
        }

        // Hitung harga setelah diskon jika ada
        $hargaSetelahDiskon = null;
        if ($request->filled('price') && $request->filled('diskon')) {
            $hargaSetelahDiskon = $request->price - ($request->price * ($request->diskon / 100));
        }

        // Buat entitas kursus baru
        $course = new KelasTatapMuka();
        $course->nama_kursus = $request->nama_kursus;
        $course->kategori_id = $request->kategori_id;
        $course->subkategori_id = $request->subkategori_id;
        $course->content = $request->content;
        $course->tingkat = $request->tingkat;
        $course->include = json_encode($request->include);
        $course->perstaratan = json_encode($request->perstaratan);
        $course->price = $request->gratis ? null : $request->price;
        $course->discount = $request->discount;
        $course->discountedPrice = $request->discountedPrice;
        $course->gambar = $gambarName;
        $course->tag = $request->tag;
        $course->durasi = $request->durasi;
        $course->sertifikat = $request->sertifikat;
        $course->kuota = $request->kuota;
        $course->user_id = $userId;
        $course->course_type = $request->course_type;
        $course->save();

        return redirect()->route('bootcampsetting')->with('success', 'Kursus berhasil disimpan.');
    }

    public function history()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $categori = Categories::all();
        $count = $categori->count();

        if (!$user) {
            return redirect()->route('login_admin');
        }

        // Mengambil semua orders yang memiliki KelasTatapMuka dengan course_type 'bootcamp'
        $orders = Order::with('KelasTatapMuka')
            ->whereHas('KelasTatapMuka', function ($query) {
                $query->where('course_type', 'bootcamp'); // Menggunakan 'course_type'
            })
            ->get();

        // Debugging data
        foreach ($orders as $order) {
            Log::info('Order ID: ' . $order->id);
            if ($order->KelasTatapMuka) {
                Log::info('Kelas Tatap Muka ID: ' . $order->KelasTatapMuka->id);
                Log::info('Nama Kelas: ' . $order->KelasTatapMuka->nama_kelas);
            } else {
                Log::info('Kelas Tatap Muka: Not Found');
            }
        }

        return view('admin.Bootcamp.history', compact('user', 'categori', 'count', 'orders', 'profile'));
    }

    public function cetak($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return view('admin.cetak', compact('order'));
    }
}
