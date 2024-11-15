<?php

namespace App\Http\Controllers;

use App\Models\Log;
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
        $kelas = KelasTatapMuka::find($id);
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
            'kurikulum',
            'kelas'
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

        // Menyimpan data ke tabel logs
        $log = new Log();
        $log->action = 'Kurikulum Ditambahkan';
        $log->description = 'Kurikulum dengan judul "' . $validatedData['title'] . '" berhasil ditambahkan untuk course ID: ' . $validatedData['course_id'];
        $log->user_id = Auth::id(); // ID pengguna yang melakukan aksi
        $log->save();
        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Kurikulum berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kurikulum = Kurikulum::find($id);

        if (!$kurikulum) {
            return response()->json(['message' => 'Kurikulum tidak ditemukan'], 404);
        }
        $log = new Log();
        $log->action = 'Kurikulum Diakses';
        $log->description = 'Kurikulum dengan judul "' . $kurikulum->title . '" telah diakses untuk edit';
        $log->user_id = Auth::id(); // ID pengguna yang melakukan aksi
        $log->save();
        return response()->json($kurikulum);
    }
    public function update(Request $request, $id)
    {
        $kurikulum = Kurikulum::find($id);

        if (!$kurikulum) {
            return redirect()->back()->with('error', 'Kurikulum tidak ditemukan');
        }

        // Validasi data yang diterima
        $request->validate([
            'title' => 'required|string|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Update data kursus
        $kurikulum->title = $request->input('title');
        // Jika Anda menambahkan field lain, lakukan update di sini

        $kurikulum->save();
        $log = new Log();
        $log->action = 'Kurikulum Diperbarui';
        $log->description = 'Kurikulum dengan judul "' . $request->input('title') . '" berhasil diperbarui';
        $log->user_id = Auth::id(); // ID pengguna yang melakukan aksi
        $log->save();
        return redirect()->back()->with('success', 'Kurikulum berhasil diperbarui');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $course = Kurikulum::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan');
        }
        $log = new Log();
        $log->action = 'Kurikulum Dihapus';
        $log->description = 'Kurikulum dengan judul "' . $course->title . '" berhasil dihapus';
        $log->user_id = Auth::id(); // ID pengguna yang melakukan aksi
        $log->save();
        $course->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
