<?php

namespace App\Http\Middleware;

use App\Constants\PermissionConstant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AccessControlMiddleware
{
    /**
     * guest routes list
     *
     * @var array
     */
    protected $guestRoutes = [
        'login',
        'logout',
        'check_email_exists',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // Check if the route is in the list of guest routes
        foreach ($this->guestRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = auth()->user();
        $access = $user->position_id ?? 1;
        $request->attributes->set('partial_access', false);
        View::share('partialAccess', false);
        switch ($access) {
            case PermissionConstant::FULL_ACCESS: // Full access
                return $next($request);
            case PermissionConstant::DENY: // No access
                abort(403);
            case PermissionConstant::PARTIAL_ACCESS: // Partial access
                $request->attributes->set('partial_access', true);
                View::share('partialAccess', true);
                break;
            default:
                abort(403);
        }
        return $next($request);
    }
}
