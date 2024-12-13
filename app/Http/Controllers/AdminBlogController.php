<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\UserProfile;
use App\Models\KategoriBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBlogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        $blog = Blog::all();
        $kategori_blog = KategoriBlog::all();
        $count = $blog->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.blog.index', compact('user', 'blog', 'count', 'kategori_blog', 'profile'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|integer|exists:kategori_blog,id',
            'content' => 'required|string',
            'tag' => 'nullable|string',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads'), $imageName);
        }

        // Simpan artikel
        $article = new Blog();
        $article->title = $request->title;
        $article->gambar = $imageName;
        $article->kategori_id = $request->kategori_id;
        $article->content = $request->content;
        $article->tag = $request->tag;
        $article->date = $request->date;
        $article->user_id = Auth::user()->id;
        $article->save();

        return redirect()->back()->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $blog->title = $request->title;
        $blog->kategori_id = $request->kategori_id;
        $blog->content = $request->content;
        $blog->tag = $request->tag;
        $blog->date = $request->date;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $blog->gambar = $filename;
        }

        $blog->save();
        return redirect()->route('kelola_blog')->with('success', 'Data updated successfully');
    }

    public function destroy($id)
    {

        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->route('kelola_blog')->with('error', 'Data tidak ditemukan');
        }

        $blog->delete();

        return redirect()->route('kelola_blog')->with('success', 'Data berhasil dihapus');
    }
}
