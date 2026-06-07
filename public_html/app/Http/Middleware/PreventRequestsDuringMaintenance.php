<?php

namespace App\Http\Middleware;

use Closure;
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
        'login',
        'logout',
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
        $isMaintenance = env('APP_MAINTENANCE', false);

        // 2. Cek jika flag diaktifkan lewat dashboard (file-based)
        if (!$isMaintenance) {
            $maintenanceFile = storage_path('app/maintenance.json');
            if (file_exists($maintenanceFile)) {
                $isMaintenance = json_decode(file_get_contents($maintenanceFile), true)['is_maintenance'] ?? false;
            }
        }

        if ($isMaintenance) {
            // 3. Izinkan bypass untuk admin, teacher, dan staff agar tetap dapat login / edit data
            if ($request->user() && in_array($request->user()->role, ['admin', 'teacher', 'staff'])) {
                return $next($request);
            }

            if (!$this->inExceptArray($request)) {
                return redirect()->route('maintenance');
            }
        }

        // 4. Fallback ke sistem maintenance bawaan Laravel (php artisan down)
        return parent::handle($request, $next);
    }
}
