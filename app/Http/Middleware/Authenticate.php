<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            // Tampilkan halaman kustom jika belum login
            abort(response()->view('errors.custom-unauthenticated', [], 401));
        }

        return null;
    }
}
