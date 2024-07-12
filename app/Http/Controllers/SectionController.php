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
            'link' => 'required|string|max:255',
        ]);

        // Hitung jumlah entri yang ada untuk mendapatkan no_urut baru
        $noUrut = Section::where('kurikulum_id', $validatedData['kurikulum_id'])->count() + 1;

        // Buat entitas Section baru
        $section = new Section;
        $section->kurikulum_id = $validatedData['kurikulum_id'];
        $section->title = $validatedData['title'];
        $section->link = $validatedData['link'];
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
        $section->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Update data kursus
        $section->title = $request->input('title');
        $section->link = $request->input('link');
        // Tambahkan update field lainnya sesuai kebutuhan

        $section->save();

        return redirect()->back()->with('success', 'Section berhasil diperbarui');
    }
}
