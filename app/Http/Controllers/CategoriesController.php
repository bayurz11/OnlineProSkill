<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categori = Categories::all();
        $count = $categori->count();
        $profile = UserProfile::where('user_id', $user->id)->first();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.categories.categories', compact('user', 'categori', 'profile', 'count'));
    }


    public function store(Request $request)
    {

        if ($request->hasFile('gambar')) {
            $gambarName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $gambarName);

            $categories = new Categories();
            $categories->gambar = $gambarName;
            $categories->name_category = $request->name_category;
            $categories->save();

            return redirect()->route('categories')->with('success', 'Kategori berhasil disimpan.');
        } else {
            return redirect()->route('categories')->with('error', 'Pilih gambar terlebih dahulu.');
        }
    }


    public function edit($id)
    {
        $categories = Categories::find($id);

        if (!$categories) {
            return response()->json(['message' => 'Categories not found'], 404);
        }

        return response()->json($categories);
    }


    public function update(Request $request, $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->name_category = $request->name_category;


        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $categories->gambar = $filename;
        }

        $categories->save();
        return redirect()->route('categories')->with('success', 'Data updated successfully');
    }
    public function updateStatus($id, Request $request)
    {
        $category = Categories::find($id);

        if ($category) {
            $category->status = $request->input('status');
            $category->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {

        $category = Categories::find($id);

        if (!$category) {
            return redirect()->route('categories')->with('error', 'Kategori tidak ditemukan');
        }

        $category->delete();

        return redirect()->route('categories')->with('success', 'Kategori berhasil dihapus');
    }
}
