<?php

namespace App\Http\Middleware;

use App\Constants\UserConstant;
use Closure;
use Illuminate\Http\Request;

class checkPosition0
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $partialAccess = $request->attributes->get('partial_access', false);
        if ($partialAccess) {
            // logout and redirect to login
            auth()->logout();
            return redirect()->route('login');
        }

        return $next($request);
    }
}
