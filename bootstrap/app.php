<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar Auth bisa terbaca

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 1. Mendaftarkan Alias Middleware Role
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        // 2. Mengatur Redirect Otomatis Berdasarkan Role
        $middleware->redirectTo(
            guests: '/login', // Jika belum login, lempar ke sini
            users: function () {
                // Jika sudah login tapi mencoba buka halaman login lagi:
                if (Auth::user()?->role === 'admin') {
                    return '/admin';
                }
                return '/dashboard';
            }
        );

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();