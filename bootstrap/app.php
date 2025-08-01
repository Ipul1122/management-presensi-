<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'pengajar.role' => \App\Http\Middleware\PengajarMiddleware::class,
            'admin.role' => \App\Http\Middleware\AdminMiddleware::class,
              // Override middleware 'auth' bawaan Laravel dengan milikmu
            'auth' => \App\Http\Middleware\Authenticate::class,
            'prevent-back-history' => \App\Http\Middleware\PreventBackHistory::class,
        ]);
        // $middleware->append(\App\Http\Middleware\Authenticate::class); 
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
