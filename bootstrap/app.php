<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api/v1'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // dd($exceptions);
        // $exceptions->report(function (NotFoundHttpException $e) {
        //     // if ($request->expectsJson()) {
        //         return response()->json([
        //             'error' => 'Not Found',
        //             'message' => 'No se pudo encontrar el recurso solicitado'
        //         ], Response::HTTP_NOT_FOUND);
        //     // }
        // });
    })->create();
