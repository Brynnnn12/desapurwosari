<?php

use App\Http\Middleware\User;
use App\Http\Middleware\Admin;
use Illuminate\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'admin' => Admin::class,
            'user' => User::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
                // Penanganan Not Found Exception
                $exceptions->render(function (NotFoundHttpException $e, $request) {
                    if ($request->is('api/*')) {
                        return response()->json(['message' => 'Resource not found.'], 404);
                    }
                    return response()->view('errors.404', [], 404);
                });

                // Penanganan Authentication Exception
                $exceptions->render(function (AuthenticationException $e, $request) {
                    if ($request->is('api/*')) {
                        return response()->json(['message' => 'Unauthorized.'], 401);
                    }
                    return response()->view('error.401', [], 401);
                });

                // Penanganan Validation Exception
                $exceptions->render(function (ValidationException $e, $request) {
                    if ($request->is('api/*')) {
                        return response()->json(['message' => 'Validation failed.', 'errors' => $e->validator->errors()], 422);
                    }
                    return response()->view('error.404', [], 422);
                });

                // Penanganan Authorization Exception
                $exceptions->render(function (AuthorizationException $e, $request) {
                    if ($request->is('api/*')) {
                        return response()->json(['message' => 'Forbidden.'], 403);
                    }
                    return response()->view('error.403', [], 403);
                });

                // Penanganan Method Not Allowed Exception
                $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
                    if ($request->is('api/*')) {
                        return response()->json(['message' => 'Method not allowed.'], 405);
                    }
                    return response()->view('error.405', [], 405);
                });

                // Penanganan Database Query Exception
                $exceptions->render(function (QueryException $e, $request) {
                    if ($request->is('api/*')) {
                        return response()->json(['message' => 'Database error.'], 500);
                    }
                    return response()->view('error.500', [], 500);
                });

                // Penanganan Exception Umum
                $exceptions->render(function (Exception $e, $request) {
                    if ($request->is('api/*')) {
                        return response()->json(['message' => 'An unexpected error occurred.'], 500);
                    }
                    return response()->view('error.500', [], 500);
                });
    })->create();
