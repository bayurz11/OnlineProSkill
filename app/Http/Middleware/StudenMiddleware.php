<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudenMiddleware
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

        // Periksa apakah role_id = 3
        if ($role && $role->role_id == 3) {
            // Jika role_id = 3, lanjutkan request
            return $next($request);
        }

        // Jika tidak, alihkan ke halaman '/'
        return redirect('/');
    }
}
