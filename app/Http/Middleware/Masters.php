<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Laracasts\Flash\Flash;

class Masters
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role,$action)
    {
        if (!Sentinel::hasAnyAccess(['admin', $role . '_' . $action])) {
            Flash::error(trans('dashboard::dashboard.flash.access_denied'));

            return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
