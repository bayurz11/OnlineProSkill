<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\UserProfile;
use App\Models\CourseMaster;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKelasTatapMukaRequest;
use App\Http\Requests\UpdateKelasTatapMukaRequest;

class KelasTatapMukaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $categori = Categories::all();
        $course = KelasTatapMuka::with('user')->where('course_type', 'offline')->get();
        $count = $course->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.KelasTatapMuka.classroom', compact('user', 'categori', 'count', 'course', 'profile'));
    }

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
        $course = new KelasTatapMuka();
        $course->nama_kursus = $request->nama_kursus;
        $course->kategori_id = $request->kategori_id;
        $course->subkategori_id = $request->subkategori_id;
        $course->content = $request->content;
        $course->tingkat = $request->tingkat;
        $course->include = json_encode($request->include);
        $course->perstaratan = json_encode($request->perstaratan);
        $course->price = $request->gratis ? null : $request->price;
        $course->discount = $request->discount;
        $course->discountedPrice = $request->discountedPrice;
        $course->gambar = $gambarName;
        $course->tag = $request->tag;
        $course->durasi = $request->durasi;
        $course->sertifikat = $request->sertifikat;
        $course->kuota = $request->kuota;
        $course->user_id = $userId;
        $course->course_type = $request->course_type;
        $course->save();

        return redirect()->route('classroomsetting')->with('success', 'Kursus berhasil disimpan.');
    }

    public function edit($id)
    {
        $course = KelasTatapMuka::find($id);

        if (!$course) {
            // Jika kursus tidak ditemukan, kembalikan respons dengan kode status 404
            return response()->json(['message' => 'Kursus tidak ditemukan'], 404);
        }

        // Kembalikan respons dengan data kursus dalam format JSON
        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $course = KelasTatapMuka::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);
            $course->gambar = $gambarName;
        }

        // Calculate discounted price if applicable
        $hargaSetelahDiskon = null;
        if ($request->filled('price') && $request->filled('diskon')) {
            $hargaSetelahDiskon = $request->price - ($request->price * ($request->diskon / 100));
        }

        // Update course fields
        $course->nama_kursus = $request->nama_kursus;
        $course->kategori_id = $request->kategori_id;
        $course->subkategori_id = $request->subkategori_id;
        $course->content = $request->content;
        $course->tingkat = $request->tingkat;
        $course->include = json_encode($request->include);
        $course->perstaratan = json_encode($request->perstaratan);
        $course->price = $request->free ? null : $request->price;
        $course->discount = $request->discount;
        $course->discountedPrice = $hargaSetelahDiskon;
        $course->tag = $request->tag;
        $course->user_id = $userId;
        $course->save();

        return redirect()->route('classroomsetting')->with('success', 'Kursus berhasil diperbarui.');
    }


    public function updateclassstatus($id, Request $request)
    {
        $course = KelasTatapMuka::find($id);

        if ($course) {
            $course->status = $request->input('status');
            $course->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {

        $course = KelasTatapMuka::find($id);

        if (!$course) {
            return redirect()->route('classroomsetting')->with('error', 'Kategori tidak ditemukan');
        }

        $course->delete();

        return redirect()->route('classroomsetting')->with('success', 'Kategori berhasil dihapus');
    }
}
