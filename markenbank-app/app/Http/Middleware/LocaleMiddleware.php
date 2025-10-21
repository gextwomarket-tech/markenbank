<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session, cookie, or default
        $locale = Session::get('locale');
        
        if (!$locale) {
            $locale = $request->cookie('locale');
        }
        
        if (!$locale) {
            $locale = config('app.locale', 'fr');
        }
        
        // Validate locale exists
        $availableLocales = ['fr', 'en']; // Add more as needed
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale', 'fr');
        }
        
        App::setLocale($locale);
        Session::put('locale', $locale);
        
        return $next($request);
    }
}
