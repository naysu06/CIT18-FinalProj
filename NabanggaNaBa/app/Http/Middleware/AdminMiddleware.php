<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            Log::info('No user is authenticated');
        } else {
            Log::info('Authenticated user: ' . Auth::user()->username);
        }

        // Ensure you're calling the isAdmin method correctly
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}

