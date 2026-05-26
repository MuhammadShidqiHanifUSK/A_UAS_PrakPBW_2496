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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(function () {
            $role = auth()->user()?->role;
            return match($role) {
                'admin'  => '/admin/users',
                'ustadz' => '/setoran',
                'santri' => '/riwayat',
                'ortu'   => '/setoran-anak',
                default  => '/dashboard',
            };
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
