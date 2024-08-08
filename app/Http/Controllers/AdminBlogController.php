<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBlogController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $blog = Blog::all();
        $count = $blog->count();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.blog.index', compact('user', 'blog', 'count'));
    }
}
