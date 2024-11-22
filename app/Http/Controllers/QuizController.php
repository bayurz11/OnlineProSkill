<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tugas;
use App\Models\Categories;
use App\Models\Pertanyaan;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\Jawaban_Siswa;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        // $quiz = Tugas::all();
        $quiz = Tugas::with('pertanyaan.jawaban')->get();

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


        // Mengambil tugas dan pertanyaan terkait, termasuk jawaban yang dipilih
        $tugas = Tugas::with(['pertanyaan.jawaban' => function ($query) use ($user) {
            $query->where('id_siswa', $user->id); // Filter jawaban berdasarkan siswa
        }, 'pertanyaan.pilihanJawaban']) // Tambahkan relasi pilihan jawaban
            ->find($id_tugas);


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

        $currentQuestionNumber = $request->input('current_question_number', 1);
        $currentQuestion = $tugas->pertanyaan()->skip($currentQuestionNumber - 1)->first();

        if ($request->ajax()) {
            // Hanya render bagian soal
            return view('studen.quiz.partial_question', compact('currentQuestion', 'currentQuestionNumber'));
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
            'daftarpesanan',
            'currentQuestion',
            'currentQuestionNumber'
        ));
    }

    // public function storeJawaban(Request $request, $id_tugas)
    // {
    //     try {
    //         // Validasi data yang dikirim
    //         $validated = $request->validate([
    //             'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
    //             'id_pilihan' => 'nullable|exists:pilihan_jawaban,id_pilihan',

    //         ]);

    //         // Simpan jawaban ke database
    //         Jawaban_Siswa::create([
    //             'id_pertanyaan' => $validated['id_pertanyaan'],
    //             'id_siswa' => auth()->user()->id,
    //             'id_pilihan' => $validated['id_pilihan'] ?? null,

    //         ]);

    //         return response()->json(['message' => 'Jawaban berhasil disimpan!'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Error: ' . $e->getMessage()], 422);
    //     }
    // }

    public function storeJawaban(Request $request, $id_tugas)
    {
        try {
            // Validasi data yang dikirim
            $validated = $request->validate([
                'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
                'id_pilihan' => 'nullable|exists:pilihan_jawaban,id_pilihan',
            ]);

            // Simpan jawaban ke database
            $jawabanSiswa = Jawaban_Siswa::create([
                'id_pertanyaan' => $validated['id_pertanyaan'],
                'id_siswa' => auth()->user()->id,
                'id_pilihan' => $validated['id_pilihan'] ?? null,
            ]);

            // Ambil pertanyaan berdasarkan id_pertanyaan
            $pertanyaan = Pertanyaan::with('pilihanJawaban')->find($validated['id_pertanyaan']);

            // Ambil pilihan jawaban yang benar untuk pertanyaan ini
            $jawabanBenar = $pertanyaan->pilihanJawaban->firstWhere('benar', true);

            // Cek apakah jawaban siswa sama dengan pilihan yang benar
            if ($jawabanBenar && $jawabanSiswa->id_pilihan == $jawabanBenar->id_pilihan) {
                $jawabanSiswa->nilai = 1; // Beri nilai 1 untuk jawaban benar
            } else {
                $jawabanSiswa->nilai = 0; // Nilai 0 untuk jawaban salah
            }

            // Simpan perubahan ke database
            $jawabanSiswa->save();

            return response()->json(['message' => 'Jawaban berhasil disimpan!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 422);
        }
    }



    public function getQuestion(Request $request, $id_tugas, $currentQuestionNumber)
    {
        $tugas = Tugas::with(['pertanyaan' => function ($query) {
            $query->with('pilihanJawaban')->orderBy('id_pertanyaan', 'asc');
        }])->find($id_tugas);

        if (!$tugas) {
            return response()->json(['error' => 'Tugas tidak ditemukan.'], 404);
        }

        $question = $tugas->pertanyaan->skip($currentQuestionNumber - 1)->first();

        if (!$question) {
            return response()->json(['error' => 'Soal tidak ditemukan.'], 404);
        }

        return response()->json([
            'currentQuestion' => $question,
            'currentQuestionNumber' => $currentQuestionNumber,
            'options' => $question->pilihanJawaban,
        ]);
    }

    public function finishQuiz(Request $request, $id_tugas)
    {
        try {
            // Dapatkan user ID dari auth, atau jika menggunakan parameter user_id
            $user_id = $request->user_id ?? auth()->user()->id;  // Jika tidak ada user_id di request, ambil dari auth

            // Ambil tugas yang sesuai dengan ID
            $tugas = Tugas::findOrFail($id_tugas);

            // Ambil semua jawaban siswa untuk tugas ini
            $jawabanSiswa = Jawaban_Siswa::where('id_siswa', $user_id)
                ->whereIn('id_pertanyaan', $tugas->pertanyaan->pluck('id_pertanyaan')) // Ambil jawaban untuk pertanyaan di tugas
                ->get();

            // Total pertanyaan dalam tugas
            $totalQuestions = $tugas->pertanyaan->count();

            // Hitung jawaban yang benar berdasarkan nilai di Jawaban_Siswa
            $correctAnswers = $jawabanSiswa->where('nilai', 1)->count();

            // Hitung skor sebagai persentase dan batasi hingga 2 desimal
            $score = ($totalQuestions > 0) ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

            return response()->json(['score' => $score], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 422);
        }
    }
}
