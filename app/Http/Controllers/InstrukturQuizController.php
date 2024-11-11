<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InstrukturQuizController extends Controller
{
    public function index()
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

        $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->pluck('total', 'product_id');

        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();
        $quiz = Tugas::all();
        return view('instruktur.Quiz.quiz', compact(
            'user',
            'KelasTatapMuka',
            'categori',
            'profile',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'orders',
            'jumlahPendaftaran',
            'quiz'
        ));
    }

    public function store(Request $request)
    {
        // Pastikan user sudah login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/'); // Jika belum login, arahkan ke halaman utama
        }

        // Validasi input dari form
        $validated = $request->validate([
            'judul_tugas' => 'required|string|max:255',
            'course_id' => 'required',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_akhir' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Menyimpan data tugas
        $quiz = new Tugas();
        $quiz->judul_tugas = $validated['judul_tugas'];
        $quiz->course_id = $validated['course_id'];
        $quiz->jam_mulai = $validated['jam_mulai'];
        $quiz->jam_akhir = $validated['jam_akhir'];
        $quiz->id_instruktur = $user->id; // Menggunakan ID instruktur dari sesi login
        $quiz->save();

        // Redirect ke halaman lain atau kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Quiz berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $quiz = Tugas::find($id);

        if (!$quiz) {
            return redirect()->back()->with('error', 'quiz tidak ditemukan');
        }

        $quiz->delete();

        return redirect()->back()->with('success', 'quiz berhasil dihapus');
    }
}
