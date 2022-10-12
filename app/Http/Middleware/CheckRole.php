<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
       
        $user = Auth::user();

        if ($user->hasAnyRole($role)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json(['error' => 'You dont have access to perform this action'], 401);
        }

        return redirect()->back();
        
        
    }
}
