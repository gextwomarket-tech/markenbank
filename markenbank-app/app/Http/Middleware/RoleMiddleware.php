<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page');
        }
        
        $user = auth()->user();
        
        // Check if user has one of the required roles
        if (!in_array($user->role, $roles)) {
            abort(403, 'Accès non autorisé');
        }
        
        return $next($request);
    }
}
