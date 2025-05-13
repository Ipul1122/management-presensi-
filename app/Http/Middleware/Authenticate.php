<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            if ($request->is('pengajar') || $request->is('pengajar/*')) {
                return route('pengajar.login');
            }

            // 🛠️ GANTI fallback ini dari:
            // return route('login');
            // MENJADI misalnya halaman utama saja:
             return route('admin.login'); // fallback
        }

        return null;
    }
}
