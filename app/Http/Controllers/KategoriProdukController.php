<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = KategoriProduk::all();
        $count = $categori->count();
        if (!$user) {
            return redirect()->route('/');
        }
        return view('admin.produk.kategori', compact('user', 'categori', 'count'));
    }


    public function store(Request $request)
    {
        $categories = new KategoriProduk();
        $categories->name_kategori = $request->name_kategori;
        $categories->save();

        return redirect()->route('kategoriproduk')->with('success', 'Kategori berhasil disimpan.');
    }



    public function edit($id)
    {
        $categories = KategoriProduk::find($id);

        if (!$categories) {
            return response()->json(['message' => 'Categories not found'], 404);
        }

        return response()->json($categories);
    }


    public function update(Request $request, $id)
    {
        $categories = KategoriProduk::findOrFail($id);
        $categories->name_kategori = $request->name_kategori;
        $categories->save();

        return redirect()->route('kategoriproduk')->with('success', 'Data updated successfully');
    }

    public function updateStatus($id, Request $request)
    {
        $category = KategoriProduk::find($id);

        if ($category) {
            $category->status = $request->input('status');
            $category->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {

        $category = KategoriProduk::find($id);

        if (!$category) {
            return redirect()->route('kategoriproduk')->with('error', 'Kategori tidak ditemukan');
        }

        $category->delete();

        return redirect()->route('kategoriproduk')->with('success', 'Kategori berhasil dihapus');
    }
}
