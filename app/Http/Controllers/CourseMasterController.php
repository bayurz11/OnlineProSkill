<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CourseMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseMasterRequest;
use App\Http\Requests\UpdateCourseMasterRequest;

class CourseMasterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.CourseMaster.course', compact('user', 'categori', 'count'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Proses unggahan gambar
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);
        } else {
            $gambarName = null;
        }

        // Hitung harga setelah diskon jika ada
        $hargaSetelahDiskon = null;
        if ($request->filled('harga') && $request->filled('diskon')) {
            $hargaSetelahDiskon = $request->harga - ($request->harga * ($request->diskon / 100));
        }

        // Buat entitas kursus baru
        $course = new CourseMaster();
        $course->nama_kursus = $request->nama_kursus;
        $course->kategori_id = $request->kategori_id;
        $course->subkategori_id = $request->subkategori_id;
        $course->content = $request->content;
        $course->tingkat = $request->tingkat;
        $course->include = json_encode($request->include);
        $course->harga = $request->gratis ? null : $request->harga;
        $course->diskon = $request->diskon;
        $course->harga_setelah_diskon = $hargaSetelahDiskon;
        $course->gratis = $request->gratis;
        $course->gambar = $gambarName;
        $course->tag = $request->tag;
        $course->save();

        return redirect()->route('CourseMaster')->with('success', 'Kursus berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(CourseMaster $courseMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseMaster $courseMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseMasterRequest $request, CourseMaster $courseMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseMaster $courseMaster)
    {
        //
    }
}
