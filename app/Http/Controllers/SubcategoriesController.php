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
}
