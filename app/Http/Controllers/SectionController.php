<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'kurikulum_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,xlsx|max:10048', // Validasi file upload
        ]);

        // Hitung jumlah entri yang ada untuk mendapatkan no_urut baru
        $noUrut = Section::where('kurikulum_id', $validatedData['kurikulum_id'])->count() + 1;

        // Buat entitas Section baru
        $section = new Section;
        $section->kurikulum_id = $validatedData['kurikulum_id'];
        $section->title = $validatedData['title'];
        $section->link = $validatedData['link'];
        $section->duration = $validatedData['duration'];
        $section->status = 0;
        $section->no_urut = $noUrut;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $section->file_path = 'uploads/' . $fileName;
        }

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
            'title' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt,xlsx|max:10048', // Validasi file upload
        ]);

        // Update data section
        $section->title = $validatedData['title'];
        $section->link = $validatedData['link'];
        $section->duration = $validatedData['duration'];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $section->file_path = 'uploads/' . $fileName;
        }

        $section->save();

        return redirect()->back()->with('success', 'Section berhasil diperbarui');
    }


    public function destroy($id)
    {
        $section = Section::find($id);

        if (!$section) {
            return redirect()->back()->with('error', 'Section tidak ditemukan');
        }

        if ($section->file_path) {
            Storage::delete($section->file_path);
        }

        $section->delete();

        return redirect()->back()->with('success', 'Section berhasil dihapus');
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
