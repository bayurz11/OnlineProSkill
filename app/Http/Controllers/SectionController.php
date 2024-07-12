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

        // Buat entitas Kurikulum baru
        $section = new Kurikulum;
        $section->kurikulum_id = $validatedData['kurikulum_id'];
        $section->title = $validatedData['title'];
        $section->link = $validatedData['link'];
        $section->no_urut = $noUrut;
        $section->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Kurikulum berhasil ditambahkan.');
    }
}
