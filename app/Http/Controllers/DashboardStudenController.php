<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardStudenController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('/');
        }
        return view('studen.dashboard', compact('user'));
    }
}
