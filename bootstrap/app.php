<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Vercel terminates TLS at its proxy and forwards the original scheme in the
        // X-Forwarded-Proto header. Without trusting that header Laravel thinks the
        // request is plain http, so asset()/@vite emit http:// URLs on an https page
        // and the browser blocks the stylesheets/scripts as mixed content.
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_PROTO,
        );

        $middleware->alias([
            'guru' => \App\Http\Middleware\Guru::class,
            'guruadmin' => \App\Http\Middleware\GuruAdmin::class,
            'admin' => \App\Http\Middleware\Admin::class,
        ]);



    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
