<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Section;
use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use App\Models\UserSectionStatus;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        return view('studen.aksespembelian', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    }

    // public function lesson($id)
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
    //     $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();


    //     return view('studen.lesson', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum'));
    // }010824

    public function lesson($id)
    {
        $categori = Categories::all();
        $cart = Session::get('cart', []);
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

        // Fetching orders related to the user
        $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();
        $kurikulum = Kurikulum::with('sections')->where('course_id', $id)->get();

        // Check if all sections are completed
        $allSectionsCompleted = $kurikulum->every(function ($kurikulumItem) {
            return $kurikulumItem->sections->every(function ($section) {
                return $section->status === 1;
            });
        });

        return view('studen.lesson', compact('user', 'categori', 'profile', 'cart', 'notifikasi', 'notifikasiCount', 'orders', 'kurikulum', 'allSectionsCompleted'));
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

    // public function updatestatus(Request $request)
    // {
    //     // Dapatkan semua kategori (jika diperlukan)
    //     $categori = Categories::all();

    //     // Dapatkan data cart dari session
    //     $cart = Session::get('cart', []);

    //     // Dapatkan pengguna yang sedang login
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->route('home');
    //     }

    //     // Dapatkan profil pengguna
    //     $profile = UserProfile::where('user_id', $user->id)->first();

    //     // Dapatkan notifikasi pengguna yang sedang login
    //     $notifikasi = NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     // Hitung notifikasi yang belum dibaca
    //     $notifikasiCount = $notifikasi->where('status', 1)->count();

    //     // Dapatkan pesanan yang terkait dengan pengguna
    //     $orders = Order::where('user_id', $user->id)->with('KelasTatapMuka')->get();

    //     // Dapatkan sectionId dari request
    //     $sectionId = $request->input('sectionId');

    //     // Temukan section berdasarkan sectionId
    //     $section = Section::find($sectionId);
    //     if (!$section) {
    //         return redirect()->back()->with('error', 'Section tidak ditemukan');
    //     }

    //     // Update status section
    //     $section->status = '1'; // Atau status yang sesuai dengan kebutuhan Anda
    //     $section->save();

    //     return redirect()->back()->with('success', 'Status section berhasil diperbarui');
    // } 010824
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

        // Jika perlu, perbarui status bagian di tabel sections
        // $section->status = '1'; // Tidak disarankan, jika menggunakan pivot table
        // $section->save();

        return redirect()->back()->with('success', 'Status bagian berhasil diperbarui');
    }
}
