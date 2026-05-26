<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): mixed
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->role;

                return redirect(match($role) {
                    'admin'  => '/admin/users',
                    'ustadz' => '/setoran',
                    'santri' => '/riwayat',
                    'ortu'   => '/setoran-anak',
                    default  => '/dashboard',
                });
            }
        }

        return $next($request);
    }
}