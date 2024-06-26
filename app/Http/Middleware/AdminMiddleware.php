<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil role_id dari model UserRoles
        $role = UserRoles::where('user_id', auth()->id())->first();

        // Periksa apakah role_id = 1
        if ($role && $role->role_id == 1) {
            // Jika role_id = 1, lanjutkan request
            return $next($request);
        }

        // Jika tidak, alihkan ke halaman '/'
        return redirect('/');
    }
}
