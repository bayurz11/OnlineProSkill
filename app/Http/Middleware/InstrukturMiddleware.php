<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstrukturMiddleware
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

        // Periksa apakah role_id = 2
        if ($role && $role->role_id == 2) {
            // Jika role_id = 2, lanjutkan request
            return $next($request);
        }

        // Jika tidak, alihkan ke halaman '/'
        return redirect('/')->with('info', 'Silahkan Masuk Terlebih Dahulu');
    }
}
