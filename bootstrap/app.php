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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'user' => \App\Http\Middleware\IsUser::class,
        ]);

        $middleware->redirectTo(
            guests: '/login',
            users: function () {
                if (auth()->check()) {
                    return auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard');
                }
                return route('login');
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, $request) {
            return back()->with('error', 'Ukuran file terlalu besar! Silakan unggah file yang lebih kecil atau hubungi admin.');
        });
    })->create();
