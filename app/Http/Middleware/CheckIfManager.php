<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user is a manager
        if (Auth::check() && Auth::user()->manager_id == null) {
            return $next($request);
        }

        // Redirect or return an error if the user is not a manager
        return redirect('/')->with('error', 'You do not have access to this section.');

    }
}
