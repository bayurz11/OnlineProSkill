<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\AdminMiddleware::class,
            'isStuden' => \App\Http\Middleware\StudenMiddleware::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,

        ]);
        // $middleware->append(AdminMiddleware::class);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'webhook/xendit*'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
