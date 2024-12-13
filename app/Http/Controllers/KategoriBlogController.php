<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use App\Models\KategoriBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriBlogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $kategori_blog = KategoriBlog::all();
        $count = $kategori_blog->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.blog.kategori', compact('user', 'kategori_blog', 'count', 'profile'));
    }

    public function store(Request $request)
    {

        // Validasi input
        $request->validate([
            'name_kategori' => 'required|string|max:255',
        ]);

        // Simpan kategori baru
        $category = new KategoriBlog();
        $category->name_kategori = $request->input('name_kategori');
        $category->save();

        return redirect()->route('kategori_blog')->with('success', 'Kategori berhasil disimpan.');
    }

    public function updateStatuskategor($id, Request $request)
    {
        $category = KategoriBlog::find($id);

        if ($category) {
            $category->status = $request->input('status');
            $category->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function edit($id)
    {
        $categories = KategoriBlog::find($id);

        if (!$categories) {
            return response()->json(['message' => 'Categories not found'], 404);
        }

        return response()->json($categories);
    }


    public function update(Request $request, $id)
    {
        $categories = KategoriBlog::findOrFail($id);
        $categories->name_kategori = $request->name_kategori;

        $categories->save();
        return redirect()->route('kategori_blog')->with('success', 'Data updated successfully');
    }

    public function destroy($id)
    {

        $category = KategoriBlog::find($id);

        if (!$category) {
            return redirect()->route('kategori_blog')->with('error', 'Kategori tidak ditemukan');
        }

        $category->delete();

        return redirect()->route('kategori_blog')->with('success', 'Kategori berhasil dihapus');
    }
}
