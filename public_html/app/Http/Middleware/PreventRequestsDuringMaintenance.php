<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = [
        'maintenance',
        'deploy-helper/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 1. Cek jika flag APP_MAINTENANCE diaktifkan lewat .env
        if (env('APP_MAINTENANCE', false)) {
            if (!$this->inExceptArray($request)) {
                return redirect()->route('maintenance');
            }
        }

        // 2. Fallback ke sistem maintenance bawaan Laravel
        return parent::handle($request, $next);
    }
}
