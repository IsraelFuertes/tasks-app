<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withProviders([
        App\Providers\AppEnvironmentServiceProvider::class,
    ])

    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withMiddleware(function (Middleware $middleware): void {
    $middleware->append(\App\Http\Middleware\SanitizeInput::class);
})
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (\Throwable $e, Request $request) {

            if (!config('app.debug')) {

                if ($request->expectsJson()) {

                    $statusCode = $e instanceof HttpException
                        ? $e->getStatusCode()
                        : 500;

                    return response()->json([
                        'error' => true,
                        'message' => $statusCode >= 500
                            ? 'Error interno del servidor.'
                            : $e->getMessage(),
                        'code' => $statusCode,
                    ], $statusCode);
                }
            }

            return null;
        });

        $exceptions->report(function (\Throwable $e): void {
            //
        });

    })->create();
