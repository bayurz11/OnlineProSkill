<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Sertifikat;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\Subcategories;
use App\Http\Controllers\Controller;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sertifikat = Sertifikat::all();
        $classroom = KelasTatapMuka::all();
        if (!$user) {
            return redirect()->route('/');
        }

        return view('admin.sertifikat.index', compact('user', 'sertifikat', 'categori', 'subcategori'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'sertifikat_id' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'keterangan' => 'required|string|max:255',
        ]);

        // Cek apakah file gambar ada
        if ($request->hasFile('gambar')) {
            // Upload gambar
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);

            // Simpan data ke database
            $sertifikat = new Sertifikat();
            $sertifikat->name = $request->name;
            $sertifikat->sertifikat_id = $request->sertifikat_id;
            $sertifikat->gambar = $gambarName;
            $sertifikat->keterangan = $request->keterangan;
            $sertifikat->kategori_id = $request->kategori_id;
            $sertifikat->subkategori_id = $request->subkategori_id;
            $sertifikat->save();

            // Redirect dengan pesan sukses
            return redirect()->route('sertifikat')->with('success', 'Sertifikat berhasil disimpan.');
        } else {
            // Redirect dengan pesan error
            return redirect()->route('sertifikat')->with('error', 'Pilih gambar terlebih dahulu.');
        }
    }


    public function edit($id)
    {
        $sertifikat = Sertifikat::find($id);

        if (!$sertifikat) {
            return response()->json(['message' => 'Sertifikat not found'], 404);
        }

        return response()->json($sertifikat);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'sertifikat_id' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'keterangan' => 'required|string|max:255',
        ]);

        // Temukan sertifikat berdasarkan ID
        $sertifikat = Sertifikat::findOrFail($id);

        // Update field yang dapat diubah
        $sertifikat->name = $request->name;
        $sertifikat->sertifikat_id = $request->sertifikat_id;
        $sertifikat->keterangan = $request->keterangan;
        $sertifikat->kategori_id = $request->kategori_id;
        $sertifikat->subkategori_id = $request->subkategori_id;

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $sertifikat->gambar = $filename;
        }

        // Simpan perubahan ke database
        $sertifikat->save();

        // Redirect dengan pesan sukses
        return redirect()->route('sertifikat')->with('success', 'Data sertifikat berhasil diperbarui.');
    }

    public function destroy($id)
    {

        $sertifikat = Sertifikat::find($id);

        if (!$sertifikat) {
            return redirect()->route('sertifikat')->with('error', 'sertifikat tidak ditemukan');
        }

        $sertifikat->delete();

        return redirect()->route('sertifikat')->with('success', 'sertifikat berhasil dihapus');
    }

    public function cetakSertifikat($id)
    {
        // Temukan sertifikat berdasarkan ID
        $sertifikat = Sertifikat::findOrFail($id);

        // Setelah menemukan sertifikat, arahkan pengguna ke view sertifikat
        return view('admin.sertifikat.sertifikat_view', compact('sertifikat'));
    }
}
