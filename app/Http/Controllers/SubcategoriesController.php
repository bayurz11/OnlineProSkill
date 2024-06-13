<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoriesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.categories.subcategories', compact('user', 'categori', 'count'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);

            $subcategories = new Categories();
            $subcategories->gambar = $gambarName;
            $subcategories->name_category = $request->name_category;
            $subcategories->name = $request->name;
            $subcategories->save();

            return redirect()->route('subcategories')->with('success', 'Kategori berhasil disimpan.');
        } else {
            return redirect()->route('subcategories')->with('error', 'Pilih gambar terlebih dahulu.');
        }
    }
}
