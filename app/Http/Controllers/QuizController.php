<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tugas;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jawaban_Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuizController extends Controller
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
        return view('studen.quiz.quiz', compact(
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

    public function viewpg(Request $request)
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('/');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();
        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        $KelasTatapMuka = KelasTatapMuka::where('user_id', $user->id)->get();

        $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->pluck('total', 'product_id');

        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();

        $id_tugas = $request->route('id_tugas');

        // Mengambil tugas dan pertanyaan terkait
        $tugas = Tugas::with(['pertanyaan' => function ($query) {
            $query->with('pilihanJawaban')
                ->orderBy('id_pertanyaan', 'asc');
        }])->find($id_tugas);

        // Menentukan nomor soal saat ini, default ke 1 jika tidak ada parameter
        $currentQuestionNumber = $request->input('current_question_number', 1);

        // Mendapatkan soal berdasarkan nomor soal saat ini
        $currentQuestion = $tugas->pertanyaan()->skip($currentQuestionNumber - 1)->first();

        // Mendapatkan semua soal untuk rangkuman
        $allQuestions = $tugas->pertanyaan;

        // Menghitung total soal
        $totalQuestions = $tugas->pertanyaan->count();

        // Mengambil daftar pesanan kelas tatap muka berdasarkan user_id dan id yang ada di order
        $daftarpesanan = KelasTatapMuka::where('user_id', $user->id)
            ->whereIn('id', function ($query) {
                $query->select('product_id')->from('orders');
            })
            ->get();

        // Menambahkan jumlah order PAID untuk setiap kelas tatap muka ke dalam koleksi
        foreach ($daftarpesanan as $kelas) {
            $kelas->jumlah_order_paid = Order::where('product_id', $kelas->id)
                ->where('status', 'PAID')
                ->count();
        }

        return view('studen.quiz.viewpg', compact(
            'user',
            'KelasTatapMuka',
            'categori',
            'profile',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'orders',
            'jumlahPendaftaran',
            'tugas',
            'currentQuestionNumber',
            'currentQuestion',
            'allQuestions',
            'totalQuestions',
            'daftarpesanan'
        ));
    }

    public function storeJawaban(Request $request, $id_tugas)
    {
        try {
            // Validasi data yang dikirim
            $validated = $request->validate([
                'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
                'id_pilihan' => 'nullable|exists:pilihan_jawaban,id_pilihan',

            ]);

            // Simpan jawaban ke database
            Jawaban_Siswa::create([
                'id_pertanyaan' => $validated['id_pertanyaan'],
                'id_siswa' => auth()->user()->id,
                'id_pilihan' => $validated['id_pilihan'] ?? null,

            ]);

            return response()->json(['message' => 'Jawaban berhasil disimpan!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 422);
        }
    }

    public function getQuestion($id_tugas, $questionNumber)
    {
        // Ambil soal berdasarkan nomor soal dan tugas
        $tugas = Tugas::find($id_tugas);
        $currentQuestion = $tugas->pertanyaan()->skip($questionNumber - 1)->first(); // Mengambil soal berdasarkan nomor

        if (!$currentQuestion) {
            return response()->json(['error' => 'Soal tidak ditemukan'], 404);
        }

        // Ambil pilihan jawaban untuk soal ini
        $options = $currentQuestion->pilihanJawaban;

        // Return data dalam format JSON
        return response()->json([
            'currentQuestionNumber' => $questionNumber,
            'currentQuestion' => $currentQuestion,
            'options' => $options
        ]);
    }
}
