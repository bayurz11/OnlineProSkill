<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Categories;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKurikulumRequest;
use App\Http\Requests\UpdateKurikulumRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{

    public function index($id)
    {
        $user = Auth::user();
        $categori = Categories::all();
        $course = KelasTatapMuka::with('user')->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.KelasTatapMuka.kurikulum', compact('user', 'categori', 'count', 'course'));
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
        // Validasi data input
        $request->validate([
            'title' => 'required|string|max:255',
            'classroom_id' => 'required|exists:kelas_tatap_muka,id', // tambahkan validasi untuk classroom_id
        ]);

        try {
            // Ambil id kelas dari form atau URL
            $classroomId = $request->input('classroom_id');

            // Temukan kelas tatap muka berdasarkan $classroomId
            $course = KelasTatapMuka::findOrFail($classroomId);

            // Buat objek Section baru
            $section = new Section();
            $section->title = $request->title;
            $section->classroom_id = $course->id;
            $section->save();

            return redirect()->route('kurikulum', ['id' => $course->id])->with('success', 'Kurikulum berhasil disimpan.');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->route('kurikulum')->with('error', 'Gagal menyimpan kurikulum: ' . $e->getMessage());
        }
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
    public function edit(Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurikulumRequest $request, Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurikulum $kurikulum)
    {
        //
    }
}
