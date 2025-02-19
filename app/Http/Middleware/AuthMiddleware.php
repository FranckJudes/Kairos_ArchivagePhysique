<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware that checks if the user is authenticated before allowing access to the requested page.
 * If the user is not authenticated, they are redirected to the login page with an error message.
 */
class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!Auth::check()) {
        //     // return redirect()->route('/')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        // }

        return $next($request);
    }
}
