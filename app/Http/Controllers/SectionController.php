<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'kurikulum_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'link' => 'string|max:255',
            'materi' => 'string|max:255',
        ]);

        // Hitung jumlah entri yang ada untuk mendapatkan no_urut baru
        $noUrut = Section::where('kurikulum_id', $validatedData['kurikulum_id'])->count() + 1;

        // Buat entitas Section baru
        $section = new Section;
        $section->kurikulum_id = $validatedData['kurikulum_id'];
        $section->title = $validatedData['title'];
        $section->link = $validatedData['link'];
        $section->materi = $validatedData['materi'];
        $section->no_urut = $noUrut;
        $section->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Section berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $section = Section::find($id);

        if (!$section) {
            return response()->json(['message' => 'Kurikulum tidak ditemukan'], 404);
        }

        return response()->json($section);
    }

    public function update(Request $request, $id)
    {
        $section = Section::find($id);

        if (!$section) {
            return redirect()->back()->with('error', 'Section tidak ditemukan');
        }

        // Validasi data yang diterima
        $validatedData = $request->validate([
            // 'kurikulum_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'link' => 'string|max:255',
            'materi' => 'string|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Update data kursus
        // $section->kurikulum_id = $validatedData['kurikulum_id'];
        $section->title = $validatedData['title'];
        $section->link = $validatedData['link'];
        $section->materi = $validatedData['materi'];
        // Tambahkan update field lainnya sesuai kebutuhan

        $section->save();

        return redirect()->back()->with('success', 'Section berhasil diperbarui');
    }

    public function destroy($id)
    {

        $section = Section::find($id);

        if (!$section) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan');
        }

        $section->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
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
}
