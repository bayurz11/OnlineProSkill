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


    public function store(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Temukan kelas tatap muka berdasarkan $id
        $kelasTatapMuka = KelasTatapMuka::find($id);

        if (!$kelasTatapMuka) {
            return redirect()->route('kurikulum')->with('error', 'Kelas Tatap Muka tidak ditemukan.');
        }

        // Simpan data baru ke dalam model Section
        $section = new Section();
        $section->title = $request->title;
        $section->classroom_id = $kelasTatapMuka->id;
        $section->save();

        return redirect()->route('kurikulum', ['id' => $id])->with('success', 'Kurikulum berhasil disimpan.');
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
