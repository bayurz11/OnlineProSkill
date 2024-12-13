<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\Subcategories;
use Illuminate\Support\Facades\Auth;

class SubcategoriesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $categori = Categories::all();
        $subcategori = Subcategories::with('category')->get();
        $count = $categori->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.categories.subcategories', compact('user', 'profile', 'categori', 'count', 'subcategori'));
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
    public function update(Request $request, $id)
    {
        $subcategories = Subcategories::findOrFail($id);
        $subcategories->category_id = $request->name_category;
        $subcategories->name = $request->name;


        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $subcategories->gambar = $filename;
        }

        $subcategories->save();
        return redirect()->route('subcategories')->with('success', 'Data updated successfully');
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

    public function edit($id)
    {
        $categories = Subcategories::find($id);

        if (!$categories) {
            return response()->json(['message' => 'Categories not found'], 404);
        }

        return response()->json($categories);
    }

    public function destroy($id)
    {

        $category = Subcategories::find($id);

        if (!$category) {
            return redirect()->route('subcategories')->with('error', 'Kategori tidak ditemukan');
        }

        $category->delete();

        return redirect()->route('subcategories')->with('success', 'Kategori berhasil dihapus');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategories::where('category_id', $categoryId)
            ->where('status', 1)
            ->get();
        return response()->json($subcategories);
    }
}
