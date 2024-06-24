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
        $course->discountedPrice = $request->discountedPrice;
        $course->free = $request->free;
        $course->gambar = $gambarName;
        $course->tag = $request->tag;
        $course->user_id = $userId;
        $course->save();

        return redirect()->route('CourseMaster')->with('success', 'Kursus berhasil disimpan.');
    }

    public function edit($id)
    {
        $course = CourseMaster::find($id);

        if (!$course) {
            return response()->json(['message' => 'course not found'], 404);
        }

        return response()->json($course);
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();  // Get the authenticated user's ID
        $course = CourseMaster::findOrFail($id);

        $course->nama_kursus = $request->nama_kursus;
        $course->kategori_id = $request->kategori_id;
        $course->subkategori_id = $request->subkategori_id;
        $course->tingkat = $request->tingkat;
        $course->content = $request->content;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->discountedPrice = $request->discountedPrice;
        $course->free = $request->has('free') ? 1 : 0;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $course->gambar = $filename;
        }

        // Handle includes
        $course->include = json_encode($request->include);

        // Save user ID who made the update
        $course->user_id = $userId;

        $course->save();

        return redirect()->route('courses')->with('success', 'Course updated successfully');
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

    public function destroy($id)
    {

        $course = CourseMaster::find($id);

        if (!$course) {
            return redirect()->route('subcategories')->with('error', 'Kategori tidak ditemukan');
        }

        $course->delete();

        return redirect()->route('subcategories')->with('success', 'Kategori berhasil dihapus');
    }
}
