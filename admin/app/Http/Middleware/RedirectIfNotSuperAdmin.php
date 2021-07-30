<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotSuperAdmin
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user && $user->is_super_admin == 1) {
            return $next($request);
        }
        return redirect('/');
    }
}