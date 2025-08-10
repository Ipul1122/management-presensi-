<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
// app/Http/Middleware/Authenticate.php
protected function redirectTo($request): ?string
{
    if (! $request->expectsJson()) {
        if ($request->is('errors.unauthorized') || $request->is('errors.unauthorized/*')) {
            return route('admin.login');
        }

        if ($request->is('errors.unauthorized') || $request->is('errors.unauthorized/*')) {
            return route('pengajar.login');
        }
        else{
            return route('unauthorized'); 
        }
    }

    return null;
}

}
