<?php

namespace App\Http\Middleware;

use Closure;

class CorsPreflight
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
        if ($request->getMethod() == "OPTIONS") {
            return response()->make('OK', 200, config('cors')['headers']);
        }
        return $next($request);
    }
}
