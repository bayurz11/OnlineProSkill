<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reviews;
use App\Models\Section;
use Barryvdh\DomPDF\PDF;
use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\Sertifikat;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use App\Models\UserSectionStatus;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AksesPembelianController extends Controller
{

    public function index()
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();
        $KelasTatapMuka = KelasTatapMuka::inRandomOrder()->get();
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();

        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Fetching orders related to the user with status PAID and SETTLED
        $orders = Order::where('user_id', $user->id)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->with('KelasTatapMuka')
            ->get();

        $kurikulum = Kurikulum::all();

        // Debugging data
        foreach ($orders as $order) {
            Log::info('Order ID: ' . $order->id);
            if ($order->KelasTatapMuka) {
                Log::info('Kelas Tatap Muka ID: ' . $order->KelasTatapMuka->id);
                Log::info('Kelas Tatap Muka Name: ' . $order->KelasTatapMuka->nama_kelas);
            } else {
                Log::info('Kelas Tatap Muka: Not Found');
            }
        }

        return view('studen.aksespembelian', compact('user', 'categori', 'profile', 'cart', 'KelasTatapMuka', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    }


    public function lesson($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $profile = UserProfile::where('user_id', $user->id)->first();
        $notifikasi = NotifikasiUser::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $notifikasiCount = $notifikasi->where('status', 1)->count();
        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();
        $kurikulum = Kurikulum::with('sections')->where('course_id', $id)->get();
        $userSectionStatuses = UserSectionStatus::where('user_id', $user->id)->pluck('status', 'section_id')->toArray();

        // Ambil course_type dari model KelasTatapMuka
        $kelas = KelasTatapMuka::where('id', $id)->first();
        if (!$kelas) {
            return abort(404, 'Kelas tidak ditemukan');
        }

        $courseType = $kelas->course_type;

        // Jika course_type bukan 'produk', lakukan pengecekan sertifikat
        $sertifikat = null;
        if ($courseType !== 'produk') {
            $sertifikat = Sertifikat::findOrFail($id);
        }

        $allSectionsCompleted = $kurikulum->every(function ($kurikulumItem) use ($userSectionStatuses) {
            $totalSections = Section::countSectionsByKurikulum($kurikulumItem->id);
            $completedSections = collect($userSectionStatuses)
                ->filter(fn($status, $section_id) => $status === 1 && Section::find($section_id)->kurikulum_id === $kurikulumItem->id)
                ->count();

            return $completedSections === $totalSections;
        });

        // Cek jika pengguna sudah memberi review untuk kelas ini
        $hasReviewed = Reviews::where('user_id', $user->id)->where('class_id', $id)->exists();

        return view('studen.lesson2', compact(
            'user',
            'sertifikat',
            'categori',
            'profile',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'orders',
            'kurikulum',
            'allSectionsCompleted',
            'hasReviewed'
        ));
    }

    // public function lesson($id)
    // {
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->route('home');
    //     }

    //     $categori = Categories::all();
    //     $cart = Session::get('cart', []);
    //     $sertifikat = Sertifikat::findOrFail($id);
    //     $profile = UserProfile::where('user_id', $user->id)->first();
    //     $notifikasi = NotifikasiUser::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    //     $notifikasiCount = $notifikasi->where('status', 1)->count();
    //     $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();
    //     $kurikulum = Kurikulum::with('sections')->where('course_id', $id)->get();
    //     $userSectionStatuses = UserSectionStatus::where('user_id', $user->id)->pluck('status', 'section_id')->toArray();

    //     $allSectionsCompleted = $kurikulum->every(function ($kurikulumItem) use ($userSectionStatuses) {
    //         $totalSections = Section::countSectionsByKurikulum($kurikulumItem->id);
    //         $completedSections = collect($userSectionStatuses)
    //             ->filter(fn($status, $section_id) => $status === 1 && Section::find($section_id)->kurikulum_id === $kurikulumItem->id)
    //             ->count();

    //         return $completedSections === $totalSections;
    //     });

    //     // Cek jika pengguna sudah memberi review untuk kelas ini
    //     $hasReviewed = Reviews::where('user_id', $user->id)->where('class_id', $id)->exists();

    //     return view('studen.lesson2', compact(
    //         'user',
    //         'sertifikat',
    //         'categori',
    //         'profile',
    //         'cart',
    //         'notifikasi',
    //         'notifikasiCount',
    //         'orders',
    //         'kurikulum',
    //         'allSectionsCompleted',
    //         'hasReviewed'
    //     ));
    // }


    public function fetchContent($id)
    {
        // Memastikan pengguna terautentikasi
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        // Mengambil data yang diperlukan
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $sertifikat = Sertifikat::findOrFail($id);
        $profile = UserProfile::where('user_id', $user->id)->first();

        // Mengambil notifikasi pengguna
        $notifikasi = NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        // Mengambil pesanan pengguna
        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();

        // Mengambil kurikulum
        $kurikulum = Kurikulum::with('sections')->where('course_id', $id)->get();

        // Mengambil status bagian pengguna
        $userSectionStatuses = UserSectionStatus::where('user_id', $user->id)
            ->pluck('status', 'section_id')
            ->toArray();

        // Memeriksa apakah semua bagian telah selesai
        $allSectionsCompleted = $kurikulum->every(function ($kurikulumItem) use ($userSectionStatuses) {
            $totalSections = Section::countSectionsByKurikulum($kurikulumItem->id);
            $completedSections = array_filter($userSectionStatuses, function ($status, $section_id) use ($kurikulumItem) {
                return $status === 1 && Section::find($section_id)->kurikulum_id === $kurikulumItem->id;
            }, ARRAY_FILTER_USE_BOTH);

            return count($completedSections) === $totalSections;
        });

        // Mengembalikan tampilan dengan data yang diperlukan
        return view('studen.partials.kurikulum-content', compact('user', 'sertifikat', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum', 'allSectionsCompleted'));
    }




    public function getContent($id)
    {
        $section = Section::findOrFail($id);
        return response()->json([
            'title' => $section->title,
            'file_type' => $section->file_type,
            'file_path' => asset($section->file_path),
        ]);
    }

    public function updatestatus(Request $request, $id)
    {
        // Dapatkan pengguna yang sedang login
        $user = Auth::user();
        if (!$user) {
            // Jika pengguna tidak ditemukan, kembalikan respons error
            return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan'], 404);
        }

        // Dapatkan sectionId dari request
        $sectionId = $request->input('sectionId');

        // Temukan section berdasarkan sectionId
        $section = Section::find($sectionId);
        if (!$section) {
            // Jika section tidak ditemukan, kembalikan respons error
            return response()->json(['success' => false, 'message' => 'Bagian tidak ditemukan'], 404);
        }

        // Perbarui status bagian untuk pengguna
        $userSectionStatus = UserSectionStatus::updateOrCreate(
            ['user_id' => $user->id, 'section_id' => $sectionId],
            ['status' => true] // Status yang menunjukkan bagian telah diselesaikan
        );

        // Jika pembaruan berhasil, kembalikan respons sukses
        return response()->json(['success' => true, 'message' => 'Status bagian berhasil diperbarui']);
    }



    protected $pdf;

    // Tambahkan konstruktor untuk dependency injection
    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    public function getKurikulum($id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }
        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();
        $kurikulum = Kurikulum::with('sections')->where('course_id', $id)->get();

        $userSectionStatuses = UserSectionStatus::where('user_id', $user->id)
            ->pluck('status', 'section_id')
            ->toArray();

        $allSectionsCompleted = $kurikulum->every(function ($kurikulumItem) use ($userSectionStatuses) {
            $totalSections = Section::countSectionsByKurikulum($kurikulumItem->id);
            $completedSections = collect($userSectionStatuses)
                ->filter(fn($status, $section_id) => $status === 1 && Section::find($section_id)->kurikulum_id === $kurikulumItem->id)
                ->count();

            return $completedSections === $totalSections;
        });
        return view('studen.kurikulum', compact('kurikulum', 'userSectionStatuses', 'allSectionsCompleted', 'user', 'orders'))->render();
    }



    public function previewCertificate(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('home')->with('error', 'Anda harus login untuk mencetak sertifikat.');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();
        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();

        $completedCourses = $orders->filter(function ($order) use ($user) {
            $kurikulum = Kurikulum::with('sections')->where('course_id', $order->KelasTatapMuka->id)->get();

            return $kurikulum->every(function ($kurikulumItem) use ($user) {
                return $kurikulumItem->sections->every(function ($section) use ($user) {
                    $userSectionStatus = UserSectionStatus::where('user_id', $user->id)
                        ->where('section_id', $section->id)
                        ->first();

                    return $userSectionStatus && $userSectionStatus->status === 1;
                });
            });
        })->values(); // Tambahkan values() untuk mereset kunci array

        if ($completedCourses->isEmpty()) {
            return redirect()->route('home')->with('error', 'Anda belum menyelesaikan kursus apapun.');
        }

        $pdfs = [];
        foreach ($completedCourses as $course) {
            $courseId = $course->KelasTatapMuka->id; // Ambil ID kursus
            $kurikulum = Kurikulum::with('sections')->where('course_id', $courseId)->first();
            $coursename = strtoupper($kurikulum->nama_kelas); // Ambil nama kursus dari kurikulum
            $certificateId = sprintf("%03d", Order::where('user_id', $user->id)->count()) . " / PSA / " . $courseId . " / " . now()->format('m.Y');

            $pdf = $this->pdf->loadView('home.sertifikat.index', [
                'user' => $user,
                'profile' => $profile,
                'completedCourses' => $completedCourses,
                'date' => now()->format('d F Y'),
                'certificateId' => $certificateId,
                'coursename' => $coursename,
            ])->setPaper('a4', 'landscape'); // Mengatur ukuran kertas menjadi legal dan orientasi landscape

            return $pdf->stream('sertifikat_penyelesaian.pdf');
        }
    }

    // public function printCertificate($id)
    // {
    //     $user = Auth::user();
    //     $profile = UserProfile::where('user_id', $user->id)->first();

    //     // Temukan sertifikat berdasarkan user_id dan sertifikat_id
    //     $sertifikat = Sertifikat::where('user_id', $user->id)->first();

    //     // Cek apakah sertifikat ditemukan
    //     if (!$sertifikat) {
    //         return response()->json(['message' => 'Sertifikat tidak ditemukan'], 404);
    //     }

    //     // Ambil link dan product_id dari sertifikat
    //     $sertifikat_id = $sertifikat->sertifikat_id;
    //     $link = $sertifikat->link;
    //     $productId = $sertifikat->product_id;

    //     // Ambil nama_kursus dari kursus menggunakan relasi
    //     $course = $sertifikat->course;
    //     $namaKursus = $course ? $course->nama_kursus : 'Nama kursus tidak ditemukan';

    //     // Cek apakah $link null atau tidak
    //     if (is_null($link)) {
    //         return response()->json(['message' => 'Link sertifikat tidak ditemukan'], 404);
    //     }

    //     // Generate QR code sebagai string SVG
    //     $qrCode = QrCode::size(300)->generate($link);

    //     // Setelah menemukan sertifikat, arahkan pengguna ke view sertifikat
    //     return view('home.sertifikat.cetak', compact('sertifikat', 'qrCode', 'user', 'profile', 'productId', 'namaKursus', 'sertifikat_id'));
    // }

    public function printCertificate($id)
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();

        // Temukan sertifikat berdasarkan user_id dan product_id
        $sertifikat = Sertifikat::where('user_id', $user->id)
            ->where('product_id', $id)
            ->first();

        // Cek apakah sertifikat ditemukan
        if (!$sertifikat) {
            return response()->json(['message' => 'Sertifikat tidak ditemukan'], 404);
        }

        // Ambil link dan product_id dari sertifikat
        $sertifikat_id = $sertifikat->sertifikat_id;
        $link = $sertifikat->link;
        $productId = $sertifikat->product_id;

        // Ambil nama_kursus dari kursus menggunakan relasi
        $course = $sertifikat->course;
        $namaKursus = $course ? $course->nama_kursus : 'Nama kursus tidak ditemukan';

        // Cek apakah $link null atau tidak
        if (is_null($link)) {
            return response()->json(['message' => 'Link sertifikat tidak ditemukan'], 404);
        }

        // Generate QR code sebagai string SVG
        $qrCode = QrCode::size(300)->generate($link);

        // Setelah menemukan sertifikat, arahkan pengguna ke view sertifikat
        return view('home.sertifikat.cetak', compact('sertifikat', 'qrCode', 'user', 'profile', 'productId', 'namaKursus', 'sertifikat_id'));
    }
}
