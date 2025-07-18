<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsEmployee;
use App\Http\Middleware\RoleRedirect; // 👈 agrega esto

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
            'employee' => EnsureUserIsEmployee::class,
            'role.redirect' => RoleRedirect::class, // 👈 agrega este alias
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

