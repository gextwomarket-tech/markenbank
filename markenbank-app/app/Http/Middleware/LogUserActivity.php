<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            // Log the page visit
            logUserVisit(
                $request->fullUrl(),
                $request->route()->getName() ?? 'unknown'
            );
        }
        
        return $next($request);
    }
}
