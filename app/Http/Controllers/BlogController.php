<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\AdminEvent;
use App\Models\Categories;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NotifikasiUser;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{


    // public function index(Request $request)
    // {
    //     $user = Auth::user();
    //     $profile = null;
    //     $cart = Session::get('cart', []);

    //     // Ambil kata kunci pencarian dari request
    //     $search = $request->input('search');

    //     // Lakukan pencarian dan tambahkan pagination
    //     $blog = Blog::when($search, function ($query, $search) {
    //         return $query->where('title', 'like', "%{$search}%")
    //             ->orWhere('tag', 'like', "%{$search}%");
    //     })->paginate(6); // Pagination dengan 6 item per halaman

    //     if ($user) {
    //         $profile = UserProfile::where('user_id', $user->id)->first();
    //     }

    //     // Ambil notifikasi untuk pengguna yang sedang login
    //     $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

    //     // Hitung jumlah notifikasi dengan status = 1
    //     $notifikasiCount = $notifikasi->where('status', 1)->count();

    //     return view('home.blog.index', compact('user', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'blog', 'search'))
    //         ->with('paginationView', 'vendor.custom');
    // }
    public function index(Request $request)
    {
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);

        // Ambil kata kunci pencarian, kategori, dan tag dari request
        $search = $request->input('search');
        $category = $request->input('category');
        $tag = $request->input('tag');

        // Ambil daftar kategori dan tag
        $categories = Blog::all();
        $tags = Blog::all();

        // Lakukan pencarian dan tambahkan pagination
        $blog = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        })
            ->when($category, function ($query, $category) {
                return $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('name', 'like', "%{$category}%");
                });
            })
            ->when($tag, function ($query, $tag) {
                return $query->whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', 'like', "%{$tag}%");
                });
            })
            ->paginate(6); // Pagination dengan 6 item per halaman

        if ($user) {
            $profile = UserProfile::where('user_id', $user->id)->first();
        }

        // Ambil notifikasi untuk pengguna yang sedang login
        $notifikasi = $user ? NotifikasiUser::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            : collect(); // Menggunakan collect() untuk membuat koleksi kosong jika pengguna belum login

        // Hitung jumlah notifikasi dengan status = 1
        $notifikasiCount = $notifikasi->where('status', 1)->count();

        return view('home.blog.index', compact('user', 'profile', 'cart', 'notifikasiCount', 'notifikasi', 'blog', 'search', 'category', 'tag', 'categories', 'tags'))
            ->with('paginationView', 'vendor.custom');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
