<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PengelolaMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('pengelola')->check()) {
            return $next($request);
        }
        return redirect()->route('pengelola.auth.login');
    }
}