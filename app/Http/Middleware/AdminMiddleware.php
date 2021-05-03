<?php

namespace App\Http\Middleware;

use App\Models\Status;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->status_id == 2 || Auth::user()->status_id == 3)) {
            return $next($request);
        }
        abort(404);
    }
}
