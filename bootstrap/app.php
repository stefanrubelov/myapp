<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        health: '/up',
        then: function () {
            Route::prefix('expenses')
                ->middleware(['web', 'auth'])
                ->group(domain_path('Expenses/Routes/web.php'));

            Route::prefix('auth')
                ->middleware(['web'])
                ->group(domain_path('Auth/Routes/web.php'));

            Route::prefix('user')
                ->middleware(['web', 'auth'])
                ->group(domain_path('User/Routes/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
