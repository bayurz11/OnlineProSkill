<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoriesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $subcategori = Subcategories::all();
        $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.categories.subcategories', compact('user', 'categori', 'count', 'subcategori'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);

            $subcategories = new Subcategories();
            $subcategories->gambar = $gambarName;
            $subcategories->category_id = $request->name_category;
            $subcategories->name = $request->name;
            $subcategories->save();

            return redirect()->route('subcategories')->with('success', 'Kategori berhasil disimpan.');
        } else {
            return redirect()->route('subcategories')->with('error', 'Pilih gambar terlebih dahulu.');
        }
    }
    public function updateSubstatus($id, Request $request)
    {
        $category = Subcategories::find($id);

        if ($category) {
            $category->status = $request->input('status');
            $category->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
