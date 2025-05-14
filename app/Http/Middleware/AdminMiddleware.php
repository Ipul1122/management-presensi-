<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Gunakan guard 'pengajar'
        if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role !== 'admin') {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->withErrors(['auth' => 'Silakan login sebagai admin.']);
        }

        return $next($request);
    }
}
