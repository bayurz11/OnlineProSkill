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
        ]);

        // Ambil id kelas dari form atau URL
        $classroomId = $request->input('classroom_id'); // Ubah sesuai dengan nama field yang digunakan di form Anda

        // Temukan kelas tatap muka berdasarkan $classroomId
        $course = KelasTatapMuka::find($classroomId);

        if ($course) {
            // Buat objek Section baru
            $section = new Section();
            $section->title = $request->title;
            $section->classroom_id = $course->id; // Sesuaikan dengan nama kolom yang sesuai
            $section->save();

            return redirect()->route('kurikulum')->with('success', 'Kurikulum berhasil disimpan.');
        }

        return redirect()->route('kurikulum')->with('error', 'Kelas tatap muka tidak ditemukan.');
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
