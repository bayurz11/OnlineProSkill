<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tugas;
use App\Models\Categories;
use App\Models\Pertanyaan;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Pilih_Jawaban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InstrukturQuestionController extends Controller
{
    public function pg()
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
        return view('instruktur.Quiz.question', compact(
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
    public function storepg(Request $request)
    {
        $request->validate([
            'questions.*.question' => 'required|string',
            'questions.*.correct_answer' => 'required|in:A,B,C,D,E',
            'questions.*.options.*' => 'required|string',
        ]);

        // Menyimpan pertanyaan dan pilihan jawabannya
        foreach ($request->questions as $questionData) {
            // Menyimpan pertanyaan
            $pertanyaan = Pertanyaan::create([
                'isi_pertanyaan' => $questionData['question'],
                'jenis_pertanyaan' => 'pilihan_ganda', // Jenis pertanyaan
                // Jika Anda memiliki id_tugas, bisa ditambahkan di sini
                // 'id_tugas' => $id_tugas,
            ]);

            // Menyimpan pilihan jawaban
            foreach ($questionData['options'] as $key => $option) {
                Pilih_Jawaban::create([
                    'id_pertanyaan' => $pertanyaan->id,
                    'isi_pilihan' => $option,
                    'is_correct' => ($key === $questionData['correct_answer']) ? 1 : 0, // Menandai jawaban benar
                ]);
            }
        }

        return redirect()->back()->with('success', 'Pertanyaan dan pilihan jawaban berhasil ditambahkan.');
    }
    public function esai()
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
        return view('instruktur.Quiz.questionesai', compact(
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
}
