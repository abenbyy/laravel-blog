<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $value)
    {
        $roles = explode(':',$value);
        if(Auth::check() && in_array(strtolower(Auth::user()->role), $roles)){
            return $next($request);    
        }
        return abort(403);
        
    }
}
