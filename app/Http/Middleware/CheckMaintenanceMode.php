<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $enabled = Setting::get('system.maintenance.enabled', false);
        $enabled = filter_var($enabled, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $enabled = $enabled ?? false;

        if (! $enabled) {
            return $next($request);
        }

        // Biar admin tetap bisa akses halaman admin saat maintenance
        if ($request->is('admin/*')) {
            return $next($request);
        }

        return response()->view('maintenance', ['enabled' => true], 503);
    }
}

