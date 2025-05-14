<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajarMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Gunakan guard 'pengajar'
        if (!Auth::guard('pengajar')->check() || Auth::guard('pengajar')->user()->role !== 'pengajar') {
            Auth::guard('pengajar')->logout();
            return redirect()->route('pengajar.login')->withErrors(['auth' => 'Silakan login sebagai pengajar.']);
        }

        return $next($request);
    }
}
