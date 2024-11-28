<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tugas;
use App\Models\Reviews;
use App\Models\Categories;
use App\Models\Pertanyaan;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\Pilih_Jawaban;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jawaban_Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InstrukturQuestionController extends Controller
{
    public function pg(Request $request)
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

        // Mengurutkan pertanyaan berdasarkan id atau urutan yang diinginkan
        $id_tugas = $request->route('id_tugas');
        $pertanyaan = Pertanyaan::where('id_tugas', $id_tugas)
            ->with('pilihanJawaban')
            ->orderBy('id_pertanyaan', 'asc') // Mengurutkan berdasarkan id atau kolom lainnya
            ->get();

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
            'pertanyaan'
        ));
    }

    public function storepg(Request $request)
    {
        // Validasi input untuk form quiz
        $request->validate([
            'judul_tugas' => 'required|string|max:255',
            'course_id' => 'required',
            'waktu_pengerjaan_jam' => 'required',
            'waktu_pengerjaan_menit' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.options.A' => 'required|string|max:255',
            'questions.*.options.B' => 'required|string|max:255',
            'questions.*.options.C' => 'required|string|max:255',
            'questions.*.options.D' => 'required|string|max:255',
            'questions.*.options.E' => 'required|string|max:255',
            'questions.*.correct_answer' => 'required|in:A,B,C,D,E',
        ]);

        // Menyimpan data quiz
        $quiz = Tugas::create([
            'judul_tugas' => $request->judul_tugas,
            'course_id' => $request->course_id,
            'id_instruktur' => $request->id_instruktur,
            'waktu_pengerjaan_jam' => $request->waktu_pengerjaan_jam,
            'waktu_pengerjaan_menit' => $request->waktu_pengerjaan_menit,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        // Menyimpan data pertanyaan pilihan ganda
        foreach ($request->input('questions') as $key => $questionData) {
            $pertanyaan = Pertanyaan::create([
                'isi_pertanyaan' => $questionData['question'],
                'jenis_pertanyaan' => 'pilihan_ganda',
                'id_tugas' => $quiz->id_tugas,  // Menyambungkan pertanyaan ke quiz
            ]);

            // Menyimpan pilihan jawaban untuk setiap pertanyaan
            foreach ($questionData['options'] as $optionKey => $optionValue) {
                $benar = ($optionKey === $questionData['correct_answer']) ? true : false;

                Pilih_Jawaban::create([
                    'id_pertanyaan' => $pertanyaan->id_pertanyaan,
                    'isi_pilihan' => $optionValue,
                    'benar' => $benar,
                ]);
            }
        }

        // Redirect atau memberi respon setelah menyimpan data
        return redirect()->route('instruktur.quiz')->with('success', 'Quiz berhasil dibuat!');
    }

    // public function viewpg(Request $request)
    // {
    //     $categori = Categories::all();
    //     $cart = Session::get('cart', []);
    //     $user = Auth::user();

    //     if (!$user) {
    //         return redirect()->route('/');
    //     }

    //     $profile = UserProfile::where('user_id', $user->id)->first();
    //     $notifikasi = NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    //     $notifikasiCount = $notifikasi->where('status', 1)->count();
    //     $KelasTatapMuka = KelasTatapMuka::where('user_id', $user->id)->get();

    //     $jumlahPendaftaran = Order::select('product_id', DB::raw('count(*) as total'))
    //         ->groupBy('product_id')
    //         ->pluck('total', 'product_id');

    //     $orders = Order::where('user_id', $user->id)
    //         ->whereIn('status', ['PAID', 'SETTLED'])
    //         ->with('KelasTatapMuka')
    //         ->get();

    //     $id_tugas = $request->route('id_tugas');

    //     // Mengambil tugas dan pertanyaan terkait
    //     $tugas = Tugas::with(['pertanyaan' => function ($query) {
    //         $query->with('pilihanJawaban')
    //             ->orderBy('id_pertanyaan', 'asc');
    //     }])->find($id_tugas);

    //     // Menentukan nomor soal saat ini, default ke 1 jika tidak ada parameter
    //     $currentQuestionNumber = $request->input('current_question_number', 1);

    //     // Mendapatkan soal berdasarkan nomor soal saat ini
    //     $currentQuestion = $tugas->pertanyaan()->skip($currentQuestionNumber - 1)->first();

    //     // Mendapatkan semua soal untuk rangkuman
    //     $allQuestions = $tugas->pertanyaan;

    //     // Menghitung total soal
    //     $totalQuestions = $tugas->pertanyaan->count();

    //     // Mengambil daftar pesanan kelas tatap muka berdasarkan user_id dan id yang ada di order
    //     $daftarpesanan = KelasTatapMuka::where('user_id', $user->id)
    //         ->whereIn('id', function ($query) {
    //             $query->select('product_id')->from('orders');
    //         })
    //         ->get();

    //     // Menambahkan jumlah order PAID untuk setiap kelas tatap muka ke dalam koleksi
    //     foreach ($daftarpesanan as $kelas) {
    //         $kelas->jumlah_order_paid = Order::where('product_id', $kelas->id)
    //             ->where('status', 'PAID')
    //             ->count();
    //     }

    //     return view('instruktur.Quiz.viewpg', compact(
    //         'user',
    //         'KelasTatapMuka',
    //         'categori',
    //         'profile',
    //         'cart',
    //         'notifikasi',
    //         'notifikasiCount',
    //         'orders',
    //         'jumlahPendaftaran',
    //         'tugas',
    //         'currentQuestionNumber',
    //         'currentQuestion',
    //         'allQuestions',
    //         'totalQuestions',
    //         'daftarpesanan',
    //     ));
    // }
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

        $tugas = Tugas::with(['pertanyaan' => function ($query) {
            $query->with('pilihanJawaban')->orderBy('id_pertanyaan', 'asc');
        }])->find($id_tugas);

        $currentQuestionNumber = $request->input('current_question_number', 1);
        $currentQuestion = $tugas->pertanyaan()->skip($currentQuestionNumber - 1)->first();
        $allQuestions = $tugas->pertanyaan;
        $totalQuestions = $tugas->pertanyaan->count();

        $daftarpesanan = KelasTatapMuka::where('user_id', $user->id)
            ->whereIn('id', function ($query) {
                $query->select('product_id')->from('orders');
            })
            ->get();

        foreach ($daftarpesanan as $kelas) {
            $kelas->jumlah_order_paid = Order::where('product_id', $kelas->id)
                ->where('status', 'PAID')
                ->count();
        }

        // Ambil tugas berdasarkan id_tugas
        $nilaiSiswa = Tugas::with(['pertanyaan.jawaban'])
            ->where('id_tugas', $id_tugas)
            ->first();

        if (!$nilaiSiswa) {
            return response()->json(['message' => 'Data tugas tidak ditemukan'], 404);
        }


        return view('instruktur.Quiz.viewpg', compact(
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
            'nilaiSiswa' // Kirim data ini ke view
        ));
    }


    public function nilai_siswa()
    {
        $jawaban_siswa = Jawaban_Siswa::all();
    }

    // public function storepg(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'questions.*.question' => 'required|string|max:255',
    //         'questions.*.options.A' => 'required|string|max:255',
    //         'questions.*.options.B' => 'required|string|max:255',
    //         'questions.*.options.C' => 'required|string|max:255',
    //         'questions.*.options.D' => 'required|string|max:255',
    //         'questions.*.options.E' => 'required|string|max:255',
    //         'questions.*.correct_answer' => 'required|in:A,B,C,D,E',
    //         'id_tugas' => 'required|exists:tugas,id_tugas',
    //     ]);

    //     // Menyimpan data pertanyaan
    //     foreach ($request->input('questions') as $key => $questionData) {
    //         $pertanyaan = Pertanyaan::create([
    //             'isi_pertanyaan' => $questionData['question'],
    //             'jenis_pertanyaan' => 'pilihan_ganda',
    //             'id_tugas' => $request->id_tugas,
    //         ]);

    //         // Menyimpan pilihan jawaban untuk setiap pertanyaan
    //         foreach ($questionData['options'] as $optionKey => $optionValue) {
    //             $benar = ($optionKey === $questionData['correct_answer']) ? true : false;

    //             Pilih_Jawaban::create([
    //                 'id_pertanyaan' => $pertanyaan->id_pertanyaan,
    //                 'isi_pilihan' => $optionValue,
    //                 'benar' => $benar,
    //             ]);
    //         }
    //     }

    //     return back()->with('success', 'Pertanyaan berhasil disimpan!');
    // }

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

    public function viewQuestion(Request $request, $id_tugas, $current_question_number)
    {
        $tugas = Tugas::with(['pertanyaan', 'KelasTatapMuka'])->findOrFail($id_tugas);
        $currentQuestion = $tugas->pertanyaan->get($current_question_number - 1); // Soal sesuai nomor
        $allQuestions = $tugas->pertanyaan;

        $totalQuestions = $tugas->pertanyaan->count();

        if ($request->ajax()) {
            return view('instruktur.partials.question', compact('currentQuestion', 'current_question_number'));
        }

        return view('instruktur.tugas.view', compact('tugas', 'currentQuestion', 'current_question_number', 'allQuestions', 'totalQuestions'));
    }
}
