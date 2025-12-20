<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/register.php',
            __DIR__.'/../routes/auth.php',
            __DIR__.'/../routes/admin.php',
            __DIR__.'/../routes/booking.php',
            __DIR__.'/../routes/courses.php',
            __DIR__.'/../routes/signature.php',
            __DIR__.'/../routes/certificate.php',
            __DIR__.'/../routes/profile.php',
            __DIR__.'/../routes/password.php',
            __DIR__.'/../routes/notification.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
