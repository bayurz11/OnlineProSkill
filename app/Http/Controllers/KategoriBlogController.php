<?php

namespace App\Http\Controllers;

use App\Models\KategoriBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriBlogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategori_blog = KategoriBlog::all();
        $count = $kategori_blog->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.blog.kategori', compact('user', 'kategori_blog', 'count'));
    }
}
