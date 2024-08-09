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

        $search = $request->input('search');
        $category = $request->input('category');
        $tag = $request->input('tag');

        // Ambil daftar kategori dari model Blog
        $categories = Blog::all(); // Asumsi Kategori adalah model untuk kategori

        // Ambil semua blog dan proses tag
        $blogs = Blog::all();
        $tags = [];
        foreach ($blogs as $blog) {
            $blogTags = json_decode($blog->tag, true); // Mengubah JSON menjadi array
            foreach ($blogTags as $blogTag) {
                if (!in_array($blogTag['value'], $tags)) {
                    $tags[] = $blogTag['value'];
                }
            }
        }
        // Lakukan pencarian dan tambahkan pagination
        $blog = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('tag', 'like', "%{$search}%");
        })
            ->when($category, function ($query, $category) {
                return $query->whereHas('kategori', function ($query) use ($category) {
                    $query->where('kategori_id', $category);
                });
            })
            ->when($tag, function ($query, $tag) {
                // Cek apakah data tag disimpan sebagai JSON
                return $query->orWhere('tag', 'like', "%{$tag}%");
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

    public function blogDetail($id, Request $request)
    {
        $categori = Categories::all();
        $user = Auth::user();
        $profile = null;
        $cart = Session::get('cart', []);
        $blog = Blog::find($id);

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

        // Bagian pencarian
        $search = $request->input('search');
        $category = $request->input('category');
        $tag = $request->input('tag');

        // Ambil semua blog dan proses tag
        $blogs = Blog::all();
        $tags = [];
        foreach ($blogs as $blogItem) {
            $blogTags = json_decode($blogItem->tag, true); // Mengubah JSON menjadi array
            foreach ($blogTags as $blogTag) {
                if (!in_array($blogTag['value'], $tags)) {
                    $tags[] = $blogTag['value'];
                }
            }
        }

        // Lakukan pencarian tanpa pagination
        $filteredBlogs = Blog::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('tag', 'like', "%{$search}%");
        })
            ->when($category, function ($query, $category) {
                return $query->whereHas('kategori', function ($query) use ($category) {
                    $query->where('kategori_id', $category);
                });
            })
            ->when($tag, function ($query, $tag) {
                // Cek apakah data tag disimpan sebagai JSON
                return $query->orWhere('tag', 'like', "%{$tag}%");
            })
            ->get(); // Mengambil semua hasil tanpa pagination

        return view('home.blog.detail', compact(
            'user',
            'profile',
            'cart',
            'notifikasiCount',
            'notifikasi',
            'categori',
            'blog',
            'filteredBlogs',
            'tags',
            'blogs'
        ));
    }
}
