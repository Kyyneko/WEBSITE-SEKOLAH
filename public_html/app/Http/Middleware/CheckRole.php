<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah pengguna telah login
        if (!$request->user()) {
            abort(403, 'Unauthorized');
        }

        // Cek apakah pengguna memiliki peran yang diperlukan
        foreach ($roles as $role) {
            if ($request->user()->role === $role) {
                return $next($request);
            }
        }

        // Jika pengguna tidak memiliki peran yang diperlukan, kembalikan response 403
        abort(403, 'Unauthorized');
    }
}
