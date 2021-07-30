<?php

namespace App\Http\Middleware;

use App\Models\College;
use Closure;

class SiteMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $route_name = $request->route()->getName();
        $payment_modes = config('app.payment_modes');
        $college_id = config('app.college_id');

        $college = College::where('id', $college_id)->first();

        view()->share('route_name', $route_name);
        view()->share('payment_modes', $payment_modes);
        view()->share('college', $college);

        // 200120
        define('IS_DEV', ($request->input('dev', 0) ? true : false));

        return $next($request);
    }
}
