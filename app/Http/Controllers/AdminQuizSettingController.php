<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tugas;
use App\Models\Categories;
use App\Models\Pertanyaan;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\Jawaban_Siswa;
use App\Models\Pilih_Jawaban;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminQuizSettingController extends Controller
{
    public function index()
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        if (!$user) {
            return redirect()->route('/');
        }
        // Mengambil profil pengguna yang sedang login
        $profile = UserProfile::where('user_id', $user->id)->first();


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
        return view('admin.quiz.index', compact(
            'user',
            'KelasTatapMuka',
            'categori',
            'profile',
            'profile',
            'orders',
            'jumlahPendaftaran',
            'quiz'
        ));
    }



    public function destroy($id_tugas)
    {

        $quiz = Tugas::where('id_tugas', $id_tugas)->first();

        if (!$quiz) {
            return redirect()->route('admin.quiz')->with('error', 'produk tidak ditemukan');
        }

        $quiz->delete();

        return redirect()->route('admin.quiz')->with('success', 'produk berhasil dihapus');
    }

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

        return view('admin.quiz.pertanyaan', compact(
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
        return redirect()->route('admin.quiz')->with('success', 'Quiz berhasil dibuat!');
    }


    public function viewpg(Request $request)
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
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

        // $nilaiSiswa = Jawaban_Siswa::with(['pertanyaan.tugas', 'siswa']) // Pastikan relasi 'siswa' ada di model
        //     ->select('id_siswa')
        //     ->selectRaw('SUM(CASE WHEN nilai = 1.00 THEN 1 ELSE 0 END) as benar')
        //     ->selectRaw('SUM(CASE WHEN nilai = 0.00 THEN 1 ELSE 0 END) as salah')
        //     ->selectRaw('SUM(CASE WHEN nilai IS NULL THEN 1 ELSE 0 END) as tidak_dijawab')
        //     ->whereHas('pertanyaan', function ($query) use ($id_tugas) {
        //         $query->where('id_tugas', $id_tugas);
        //     })
        //     ->groupBy('id_siswa')
        //     ->get();
        $nilaiSiswa = Jawaban_Siswa::with(['pertanyaan.tugas', 'siswa']) // Pastikan relasi 'siswa' ada di model
            ->select('id_siswa')
            ->selectRaw('SUM(CASE WHEN nilai = 1.00 THEN 1 ELSE 0 END) as benar')
            ->selectRaw('SUM(CASE WHEN nilai = 0.00 THEN 1 ELSE 0 END) as salah')
            ->selectRaw('SUM(CASE WHEN nilai IS NULL THEN 1 ELSE 0 END) as tidak_dijawab')
            ->selectRaw('COUNT(nilai) as total_pertanyaan')
            ->selectRaw('ROUND((SUM(CASE WHEN nilai = 1.00 THEN 1 ELSE 0 END) / COUNT(nilai)) * 100, 2) as nilai')
            ->whereHas('pertanyaan', function ($query) use ($id_tugas) {
                $query->where('id_tugas', $id_tugas);
            })
            ->groupBy('id_siswa')
            ->get();



        return view('admin.quiz.viewpg', compact(
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
            'profile',
            'nilaiSiswa'
        ));
    }


    public function nilai_siswa()
    {
        $jawaban_siswa = Jawaban_Siswa::all();
    }



    public function esai()
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
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
            'profile',
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
