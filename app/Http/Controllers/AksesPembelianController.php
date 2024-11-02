<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
    // public function index()
    // {
    //     $categori = Categories::all();
    //     $cart = Session::get('cart', []);
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->route('home');
    //     }

    //     $profile = UserProfile::where('user_id', $user->id)->first();

    //     $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         : collect();

    //     $notifikasiCount = $notifikasi->where('status', 1)->count();

    //     // Fetching orders related to the user
    //     $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();
    //     $kurikulum = Kurikulum::all();
    //     // Debugging data
    //     foreach ($orders as $order) {
    //         Log::info('Order ID: ' . $order->id);
    //         if ($order->KelasTatapMuka) {
    //             Log::info('Kelas Tatap Muka ID: ' . $order->KelasTatapMuka->id);
    //             Log::info('Kelas Tatap Muka Name: ' . $order->KelasTatapMuka->nama_kelas);
    //         } else {
    //             Log::info('Kelas Tatap Muka: Not Found');
    //         }
    //     }

    //     return view('studen.aksespembelian', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    // }220724
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


    // public function lesson($id)
    // {
    //     $categori = Categories::all();
    //     $cart = Session::get('cart', []);
    //     $sertifikat = Sertifikat::findOrFail($id);
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->route('home');
    //     }

    //     $profile = UserProfile::where('user_id', $user->id)->first();

    //     $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         : collect();

    //     $notifikasiCount = $notifikasi->where('status', 1)->count();

    //     // Fetching orders related to the user
    //     $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();
    //     $kurikulum = Kurikulum::with('sections')->where('course_id', $id)->get();

    //     // Fetch user section statuses
    //     $userSectionStatuses = UserSectionStatus::where('user_id', $user->id)
    //         ->pluck('status', 'section_id')
    //         ->toArray();

    //     // Check if all sections are completed by user
    //     $allSectionsCompleted = $kurikulum->every(function ($kurikulumItem) use ($userSectionStatuses) {
    //         return $kurikulumItem->sections->every(function ($section) use ($userSectionStatuses) {
    //             return isset($userSectionStatuses[$section->id]) && $userSectionStatuses[$section->id] === 1;
    //         });
    //     });

    //     return view('studen.lesson', compact('user', 'sertifikat', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum', 'allSectionsCompleted'));
    // }
    public function lesson($id)
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
        $sertifikat = Sertifikat::findOrFail($id);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect();
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();

        // Mengambil data sections terkait course_id
        $sections = Section::whereHas('kurikulum', function ($query) use ($id) {
            $query->where('course_id', $id);
        })->get();

        $userSectionStatuses = UserSectionStatus::where('user_id', $user->id)
            ->pluck('status', 'section_id')
            ->toArray();

        $allSectionsCompleted = $sections->every(function ($section) use ($userSectionStatuses) {
            return isset($userSectionStatuses[$section->id]) && $userSectionStatuses[$section->id] == 1;
        });

        return view('studen.lesson', compact(
            'user',
            'sertifikat',
            'categori',
            'profile',
            'cart',
            'notifikasi',
            'notifikasiCount',
            'orders',
            'sections',
            'allSectionsCompleted'
        ));
    }


    public function fetchContent($id)
    {

        // $kurikulum = Kurikulum::with('sections')->where('id', $kurikulum_id)->get();
        $kurikulum = Section::with('kurikulum')->where('kurikulum_id', $id)->get();

        return view('studen.partials.kurikulum-content', compact('kurikulum'));
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

    public function updatestatus(Request $request)
    {
        // Dapatkan pengguna yang sedang login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        // Dapatkan sectionId dari request
        $sectionId = $request->input('sectionId');

        // Temukan section berdasarkan sectionId
        $section = Section::find($sectionId);
        if (!$section) {
            return redirect()->back()->with('error', 'Bagian tidak ditemukan');
        }

        // Perbarui status bagian untuk pengguna
        $userSectionStatus = UserSectionStatus::updateOrCreate(
            ['user_id' => $user->id, 'section_id' => $sectionId],
            ['status' => true] // Status yang menunjukkan bagian telah diselesaikan
        );


        return redirect()->back()->with('success', 'Status bagian berhasil diperbarui');
    }


    protected $pdf;

    // Tambahkan konstruktor untuk dependency injection
    public function __construct(PDF $pdf)
    {
        $this->pdf = $pdf;
    }

    // public function printCertificate(Request $request)
    // {
    //     $user = Auth::user();

    //     if (!$user) {
    //         return redirect()->route('home')->with('error', 'Anda harus login untuk mencetak sertifikat.');
    //     }

    //     $profile = UserProfile::where('user_id', $user->id)->first();
    //     $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();

    //     $completedCourses = $orders->filter(function ($order) use ($user) {
    //         $kurikulum = Kurikulum::with('sections')->where('course_id', $order->KelasTatapMuka->id)->get();

    //         return $kurikulum->every(function ($kurikulumItem) use ($user) {
    //             return $kurikulumItem->sections->every(function ($section) use ($user) {
    //                 $userSectionStatus = UserSectionStatus::where('user_id', $user->id)
    //                     ->where('section_id', $section->id)
    //                     ->first();

    //                 return $userSectionStatus && $userSectionStatus->status === 1;
    //             });
    //         });
    //     })->values(); // Tambahkan values() untuk mereset kunci array

    //     if ($completedCourses->isEmpty()) {
    //         return redirect()->route('home')->with('error', 'Anda belum menyelesaikan kursus apapun.');
    //     }

    //     $pdfs = [];
    //     foreach ($completedCourses as $course) {
    //         $courseId = $course->KelasTatapMuka->id; // Ambil ID kursus
    //         $kurikulum = Kurikulum::with('sections')->where('course_id', $courseId)->first();
    //         $coursename = strtoupper($kurikulum->nama_kelas); // Ambil nama kursus dari kurikulum
    //         $certificateId = sprintf("%03d", Order::where('user_id', $user->id)->count()) . " / PSA / " . $courseId . " / " . now()->format('m.Y');

    //         $pdf = $this->pdf->loadView('home.sertifikat.index', [
    //             'user' => $user,
    //             'profile' => $profile,
    //             'completedCourses' => $completedCourses,
    //             'date' => now()->format('d F Y'),
    //             'certificateId' => $certificateId,
    //             'coursename' => $coursename,
    //         ])->setPaper('legal', 'landscape'); // Mengatur ukuran kertas menjadi legal dan orientasi landscape

    //         return $pdf->download('sertifikat_penyelesaian.pdf');
    //     }
    // }




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

    public function printCertificate($id)
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();

        // Temukan sertifikat berdasarkan user_id dan sertifikat_id
        $sertifikat = Sertifikat::where('user_id', $user->id)->first();

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
