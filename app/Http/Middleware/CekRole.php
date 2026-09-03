<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::user()->role !== $role) {
            abort(403, "Anda tidak punya akses!");
        }
        return $next($request);
    }
}
