<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin {
    
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next) {

        $authenticatedUser = Auth::user();

        if ($authenticatedUser && $authenticatedUser->isAdmin()) {
            return $next($request);
        }

        return redirect('/');
        
    }
    
}
