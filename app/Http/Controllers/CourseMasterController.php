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
        $course = CourseMaster::with('user')->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.CourseMaster.course', compact('user', 'categori', 'count', 'course'));
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
        $userId = Auth::id();
        // Proses unggahan gambar
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);
        } else {
            $gambarName = null;
        }

        // Hitung harga setelah diskon jika ada
        $hargaSetelahDiskon = null;
        if ($request->filled('price') && $request->filled('diskon')) {
            $hargaSetelahDiskon = $request->price - ($request->price * ($request->diskon / 100));
        }

        // Buat entitas kursus baru
        $course = new CourseMaster();
        $course->nama_kursus = $request->nama_kursus;
        $course->kategori_id = $request->kategori_id;
        $course->subkategori_id = $request->subkategori_id;
        $course->content = $request->content;
        $course->tingkat = $request->tingkat;
        $course->include = json_encode($request->include);
        $course->price = $request->gratis ? null : $request->price;
        $course->discount = $request->discount;
        $course->discountedPrice = $hargaSetelahDiskon;
        $course->free = $request->free;
        $course->gambar = $gambarName;
        $course->tag = $request->tag;
        $course->user_id = $userId;
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
    public function updateCoursestatus($id, Request $request)
    {
        $course = CourseMaster::find($id);

        if ($course) {
            $course->status = $request->input('status');
            $course->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseMaster $courseMaster)
    {
        //
    }
}
