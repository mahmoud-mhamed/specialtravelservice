<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',then: function () {
        $web_localization_middleware = ['web'];
        Route::middleware($web_localization_middleware)
            ->prefix( 'dashboard')
            ->as('dashboard.')
            ->group(base_path('routes/dashboard.php'));
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
        $middleware->redirectGuestsTo('dashboard/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
