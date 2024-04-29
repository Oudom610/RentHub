<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureTenantIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (!Auth::guard('tenant')->check()) {
    //         return redirect()->route('login-tenant');
    //     }

    //     return $next($request);
    // }
    
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('tenant')->check()) {
            // Not authenticated, redirect to landlord login
            // Not authenticated, redirect to landlord login
            Log::info('Tenant is not authenticated, redirecting...');
            return redirect()->route('login-tenant');
        }

        return $next($request);
    }


}
