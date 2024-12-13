<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKurikulumRequest;
use App\Http\Requests\UpdateKurikulumRequest;

class KurikulumController extends Controller
{

    public function index($id)
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $categori = Categories::all();
        $kurikulum = Kurikulum::with('user')->where('course_id', $id)->get();
        $cours = KelasTatapMuka::all();
        $section = Section::all();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.KelasTatapMuka.kurikulum', compact('user', 'categori', 'kurikulum', 'cours', 'section', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Kurikulum berhasil ditambahkan.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kurikulum = Kurikulum::find($id);

        if (!$kurikulum) {
            return response()->json(['message' => 'Kurikulum tidak ditemukan'], 404);
        }

        return response()->json($kurikulum);
    }



    /**
     * Update the specified resource in storage.
     */
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
        // Tambahkan update field lainnya sesuai kebutuhan

        $kurikulum->save();

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

        $course->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }
}
