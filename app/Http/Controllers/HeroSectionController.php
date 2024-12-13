<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeroSectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();
        if (!$user) {
            return redirect()->route('login_admin');
        }
        return view('admin.herosection.index', compact('user', 'profile'));
    }
}
