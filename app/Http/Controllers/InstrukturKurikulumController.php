<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InstrukturKurikulumController extends Controller
{
    public function index($id)
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }
        // Mengambil profil pengguna yang sedang login
        $profile = UserProfile::where('user_id', $user->id)->first();
        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Ambil KelasTatapMuka berdasarkan user_id pengguna yang sedang login
        $KelasTatapMuka = KelasTatapMuka::where('user_id', $user->id)->get();
        $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();
        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();

        return view('instruktur.kurikulum.index', compact(
            'user',
            'KelasTatapMuka',
            'categori',
            'profile',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'orders',
            'kurikulum'
        ));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'course_id' => 'required|integer',
            'title' => 'required|string|max:255',
        ]);

        // Hitung jumlah entri yang ada untuk mendapatkan no_urut baru
        $noUrut = Kurikulum::where('course_id', $validatedData['course_id'])->count() + 1;

        // Buat entitas Kurikulum baru
        $kurikulum = new Kurikulum;
        $kurikulum->course_id = $validatedData['course_id'];
        $kurikulum->title = $validatedData['title'];
        $kurikulum->no_urut = $noUrut;
        $kurikulum->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Kurikulum berhasil ditambahkan.');
    }
}
